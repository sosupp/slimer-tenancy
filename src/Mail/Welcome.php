<?php

namespace Sosupp\SlimerTenancy\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $owner,
        public $businessName,
        public $url,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to SUSU CRM - Let\'s Grow Your Business!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'slimer-tenancy::emails.welcome',
            with: [
                'userName' => $this->owner,
                'businessName' => $this->businessName,
                'loginUrl' => $this->url,
                'setupGuideUrl' => $this->url,
                'supportEmail' => 'support@susucrm.com',
                'knowledgeBaseUrl' => '#',
                'webinarUrl' => 'https://susucrm.com/webinars/getting-started',
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
