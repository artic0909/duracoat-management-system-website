<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeliveryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobcard;
    public $mailData;

    /**
     * Create a new message instance.
     */
    public function __construct($jobcard, array $mailData = [])
    {
        $this->jobcard = $jobcard;
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Material Delivery Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.delivery-mail',
            with: [
                'jobcard' => $this->jobcard,
                'mailData' => $this->mailData,
            ]
        );
    }

    /**
     * Attach files if needed
     */
    public function attachments(): array
    {
        return [];
    }
}
