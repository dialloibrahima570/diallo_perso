<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $messageText;

    public function __construct(array $data)
    {
        $this->name        = $data['name'];
        $this->messageText = $data['message'];
        $this->subject     = $data['subject'];
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.reply_contact');
    }
}
