<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TelechargerCV;
use Illuminate\Support\Facades\URL;

class SendCVMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cvRequest;
    public $messageText;

    /**
     * Crée le mail
     *
     * @param TelechargerCV $cvRequest
     * @param string $filePath
     * @param string|null $messageText
     */
    public function __construct(TelechargerCV $cvRequest, $filePath, $messageText = null)
    {
        $this->cvRequest = $cvRequest;
        $this->messageText = $messageText;

        // Génération du lien sécurisé (30 minutes)
        $this->cvRequest->download_link = URL::temporarySignedRoute(
            'download.cv',         // route
            now()->addMinutes(30), // durée de validité
            ['id' => $cvRequest->id]
        );

        $this->cvRequest->file_path = $filePath;
    }

    public function build()
    {
        $mail = $this->subject('Votre CV demandé')
                     ->view('emails.send_cv')
                     ->with([
                         'link' => $this->cvRequest->download_link,
                         'messageText' => $this->messageText
                     ]);

        // Si le CV est un fichier stocké et pas un lien externe
      // if (is_file(storage_path('app/public/' . $this->cvRequest->file_path))) {
       //    $mail->attach(storage_path('app/public/' . $this->cvRequest->file_path));
        //}

        return $mail;
    }
}
