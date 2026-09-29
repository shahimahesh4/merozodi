<?php

namespace App\Mail;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KycStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $status = 'approved',
        public ?string $rejectionReason = null
    ) {
    }

    public function envelope(): Envelope
    {
        $siteName = SiteSetting::get('site_name', 'MeroZodi');
        $subject = $this->status === 'approved'
            ? "✓ Congratulations! Your profile is now KYC Verified on {$siteName}"
            : "⚠️ Action Required: KYC Document Verification Update - {$siteName}";

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.kyc-status',
            with: [
                'user' => $this->user,
                'status' => $this->status,
                'rejectionReason' => $this->rejectionReason,
                'preheader' => $this->status === 'approved'
                    ? 'Your KYC verification is complete. The blue tick trust badge is now active on your profile.'
                    : 'Your document submission requires a quick update to complete your verification.',
            ],
        );
    }
}
