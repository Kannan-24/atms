<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BusArrived extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;
    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bus No: ' . $this->data['bus_number'] . ' has arrived close to you',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bus-arrived',
            with: [
                'student_name' => $this->data['student_name'],
                'bus_number' => $this->data['bus_number'],
                'bus_driver' => $this->data['bus_driver'],
                'bus_driver_phone' => $this->data['bus_driver_phone'],
                'faculty_name' => $this->data['faculty_name'],
                'faculty_phone' => $this->data['faculty_phone'],
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
