<?php

namespace App\Mail;

use App\Models\Payment;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Payment $payment)
    {
    }

    public function envelope(): Envelope
    {
        $siteName = SiteSetting::get('site_name', 'MeroZodi');
        return new Envelope(
            subject: "Payment Confirmed & Subscription Invoice - {$siteName}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-receipt',
            with: [
                'payment' => $this->payment,
                'preheader' => "Receipt for payment of NPR {$this->payment->amount} on MeroZodi.",
            ],
        );
    }
}
