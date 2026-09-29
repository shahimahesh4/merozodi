<?php

namespace App\Mail;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MatchInterestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $recipient, public User $sender)
    {
    }

    public function envelope(): Envelope
    {
        $siteName = SiteSetting::get('site_name', 'MeroZodi');
        return new Envelope(
            subject: "💖 {$this->sender->name} expressed interest in your profile on {$siteName}!",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.match-interest',
            with: [
                'recipient' => $this->recipient,
                'sender' => $this->sender,
                'preheader' => "{$this->sender->name} has viewed your profile and expressed interest in connecting with you.",
            ],
        );
    }
}
