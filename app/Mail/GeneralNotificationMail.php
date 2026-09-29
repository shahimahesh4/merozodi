<?php

namespace App\Mail;

use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GeneralNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $title,
        public string $messageBody,
        public ?string $userName = null,
        public ?string $subtitle = null,
        public ?string $badge = 'Notification',
        public ?string $highlightText = null,
        public ?string $actionUrl = null,
        public ?string $actionText = null,
        public ?string $mailSubject = null
    ) {
    }

    public function envelope(): Envelope
    {
        $siteName = SiteSetting::get('site_name', 'MeroZodi');
        return new Envelope(
            subject: $this->mailSubject ?? "[{$siteName}] {$this->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notification',
            with: [
                'title' => $this->title,
                'messageBody' => $this->messageBody,
                'userName' => $this->userName,
                'subtitle' => $this->subtitle,
                'badge' => $this->badge,
                'highlightText' => $this->highlightText,
                'actionUrl' => $this->actionUrl,
                'actionText' => $this->actionText,
                'preheader' => strip_tags(substr($this->messageBody, 0, 100)),
            ],
        );
    }
}
