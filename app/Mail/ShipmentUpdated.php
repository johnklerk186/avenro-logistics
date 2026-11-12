<?php

namespace App\Mail;

use App\Models\Shipment;
use App\Models\ShipmentUpdate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShipmentUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $shipment;
    public $update;

    /**
     * Create a new message instance.
     */
    public function __construct(Shipment $shipment, ShipmentUpdate $update)
    {
        $this->shipment = $shipment;
        $this->update = $update;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipment Update - ' . ucwords(str_replace('_', ' ', $this->update->status)) . ' - Tracking #' . $this->shipment->tracking_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shipment.updated',
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
