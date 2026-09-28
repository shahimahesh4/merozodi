<?php

namespace App\Livewire;

use App\Models\ContactInquiry;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactUs extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'phone' => 'nullable|string|max:30',
        'subject' => 'required|string|max:200',
        'message' => 'required|string|min:10|max:3000',
    ];

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->name = $user->name ?? '';
            $this->email = $user->email ?? '';
            $this->phone = $user->phone ?? '';
        }
    }

    public function submitInquiry()
    {
        $this->validate();

        $inquiry = ContactInquiry::create([
            'name' => trim($this->name),
            'email' => trim($this->email),
            'phone' => trim($this->phone),
            'subject' => trim($this->subject),
            'message' => trim($this->message),
            'status' => 'new',
            'is_read' => false,
        ]);

        session()->flash('contact_success', 'Namaste ' . $this->name . '! Your inquiry (Ref: #MZ-' . $inquiry->id . ') has been received. A dedicated relationship officer will respond within 2–4 business hours.');

        if (Auth::check()) {
            $this->reset(['subject', 'message']);
        } else {
            $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        }
    }

    public function render()
    {
        // 1. Fetch Dynamic CMS Page
        $page = Page::where('slug', 'contact-us')->where('is_published', true)->first();

        // 2. Dynamic contact info with SiteSetting fallbacks
        $phone = $page?->contact_phone ?: SiteSetting::get('helpline_phone', '+977-1-4567890');
        $whatsapp = ($page?->extra_data['whatsapp_number'] ?? null) ?: SiteSetting::get('whatsapp_desk', '+977-9801234567');
        $email = $page?->contact_email ?: SiteSetting::get('support_email', 'support@merozodi.com');
        $address = $page?->contact_address ?: SiteSetting::get('office_address', 'Lazimpat, Kathmandu, Nepal');
        
        $rawHeroBadge = $page?->extra_data['hero_badge'] ?? 'Dedicated Nepali Matrimonial Helpdesk';
        $heroBadge = trim(str_replace('🇳🇵', '', $rawHeroBadge));
        $weekdayHours = $page?->extra_data['visiting_hours_weekdays'] ?? 'Sunday – Friday: 9:00 AM – 6:00 PM NPT';
        $weekendHours = $page?->extra_data['visiting_hours_weekend'] ?? 'Saturday & Holidays: 24/7 WhatsApp Desk';
        
        $mapEmbedUrl = $page?->extra_data['map_embed_url'] ?? 'https://www.openstreetmap.org/export/embed.html?bbox=85.312%2C27.705%2C85.324%2C27.715&layer=mapnik&marker=27.710%2C85.318';
        $mapDirectionsUrl = $page?->extra_data['map_directions_url'] ?? 'https://maps.google.com/?q=Lazimpat,+Kathmandu,+Nepal';

        // 3. Dynamic FAQs
        $rawFaqs = $page?->extra_data['faqs'] ?? null;
        if (is_array($rawFaqs) && count($rawFaqs) > 0) {
            $faqs = $rawFaqs;
        } else {
            $faqs = [
                [
                    'question' => 'How long does KYC verification take?',
                    'answer' => 'Identity documents (Citizenship, Passport, or National ID) submitted in My KYC are reviewed by our trust & safety team within 1 to 2 business hours.',
                ],
                [
                    'question' => 'How does 36 Gun Milan matching work?',
                    'answer' => 'Our Vedic algorithm automatically matches 8 celestial Kootas (Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi) plus Manglik compatibility when viewing any member profile.',
                ],
                [
                    'question' => 'Which payment methods are accepted in Nepal?',
                    'answer' => 'We support instant automated checkout via eSewa, Khalti, Fonepay Dynamic QR, and ConnectIPS with instant invoice generation.',
                ],
                [
                    'question' => 'How can I protect my photos from public view?',
                    'answer' => 'Enable Photo Privacy Shield in your Profile Settings. Your photos will be frosted and blurred; other users must send you a photo access request which you can approve or decline at your convenience.',
                ],
            ];
        }

        return view('livewire.contact-us', [
            'page' => $page,
            'phone' => $phone,
            'whatsapp' => $whatsapp,
            'email' => $email,
            'address' => $address,
            'heroBadge' => $heroBadge,
            'weekdayHours' => $weekdayHours,
            'weekendHours' => $weekendHours,
            'mapEmbedUrl' => $mapEmbedUrl,
            'mapDirectionsUrl' => $mapDirectionsUrl,
            'faqs' => $faqs,
        ])->layout('components.layouts.app', [
            'title' => ($page->meta_title ?? 'Contact Us & Member Helpdesk') . ' - MeroZodi',
        ]);
    }
}
