<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($notification)
    {
        $this->data = $notification;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->markdown('emails.emailNotifications',['data'=>$this->data])->subject('Email Notification - '.env('APP_NAME'));
    }
}
