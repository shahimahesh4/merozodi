<?php

namespace App\Mail;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMemberMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function envelope(): Envelope
    {
        $siteName = SiteSetting::get('site_name', 'MeroZodi');
        return new Envelope(
            subject: "Namaste & Welcome to {$siteName} Nepal Matrimony! 🙏",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: [
                'user' => $this->user,
                'preheader' => 'Welcome to Nepal\'s premier verified matrimonial platform.',
            ],
        );
    }
}
