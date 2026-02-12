<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RequestItem;

class RequestProcessedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestItem;

    // Recevoir l'objet RequestItem
    public function __construct(RequestItem $requestItem)
    {
        $this->requestItem = $requestItem;
    }

    public function build()
    {
        // Ici on définit le sujet et la vue à utiliser pour le mail
        return $this->subject('Votre demande a été traitée')
                    ->view('emails.request_processed');
    }
}
