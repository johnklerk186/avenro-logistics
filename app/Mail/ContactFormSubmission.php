<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('emails.contact.submission')
                    ->subject('New Contact Form Submission')
                    ->with([
                        'name' => $this->data['name'],
                        'email' => $this->data['email'],
                        'phone' => $this->data['phone'] ?? 'Not provided',
                        'subject' => $this->data['subject'],
                        'messageContent' => $this->data['message'],
                        'service' => $this->data['service_type'] ?? 'Not specified'
                    ]);
    }
} 