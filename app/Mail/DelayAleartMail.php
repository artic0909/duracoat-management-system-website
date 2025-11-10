<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class DelayAleartMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobcard;
    public $diffDays;

    /**
     * Create a new message instance.
     */
    public function __construct($jobcard, $diffDays)
    {
        $this->jobcard = $jobcard;
        $this->diffDays = $diffDays;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⚠️ Powder Application Delay Alert - Jobcard #' . $this->jobcard->jobcard_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.delay-alert-mail',
            with: [
                'jobcard' => $this->jobcard,
                'diffDays' => $this->diffDays,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
