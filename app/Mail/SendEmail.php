<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Headers;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    protected $viewName;
    protected $content;
    
    /**
     * Create a new message instance.
     */
    public function __construct(string $subject,string $viewName, string $content)
    {
        $this->subject = $subject;
        $this->viewName = $viewName;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

     /**
      * Get the message headers.
      */
    public function headers(): Headers
    {
        return new Headers(
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->viewName,
            with: [
                'content' => $this->content,
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