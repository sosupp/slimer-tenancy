<?php

namespace Sosupp\SlimerTenancy\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompleteDemoAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $demo,
    )
    {

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Complete Demo Account',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $demolink = config('app.env') == 'production'
            ? 'https://susu-crm.com/demo-account/'.$this->demo->otp
            : 'http://susu-crm.test/demo-account/'.$this->demo->otp;

        // dd($demolink);

        return new Content(
            view: 'slimer-tenancy::emails.complete-demo-account',
            with: [
                'demoLink' => $demolink,
                'owner' => $this->demo->owner,
                'guidebookUrl' => '',
                'completionPercentage' => '',
                'token' => $this->demo->otp,

            ]
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
