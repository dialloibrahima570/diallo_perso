<?php

namespace App\Mail;

use App\Models\RequestItem;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestApprovedMail extends Mailable
{
    use SerializesModels;

    public RequestItem $requestItem;

    public function __construct(RequestItem $requestItem)
    {
        $this->requestItem = $requestItem;
    }

    public function build()
    {
        return $this->subject('Demande approuvée')
                    ->view('emails.request_approved');
    }
}
