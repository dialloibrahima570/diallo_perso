<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;
    public $status;

    public function __construct($requestData, $status)
    {
        $this->requestData = $requestData; // ProjectRequest ou TelechargerCV
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Mise à jour de votre demande')
                    ->view('emails.status_update'); // on créera ce blade
    }
}
