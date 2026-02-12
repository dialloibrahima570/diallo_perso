<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class SendProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $messageText;

    public function __construct($project, $filePath, $messageText = null)
    {
        $this->project = $project;
        $this->messageText = $messageText;

        // Toujours générer un lien sécurisé même pour lien externe
        $this->project->download_link = URL::temporarySignedRoute(
            'download.project',
            now()->addMinutes(30),
            ['id' => $project->id]
        );

        $this->project->file_path = $filePath;
    }

    public function build()
    {
        $mail = $this->subject('Votre projet demandé')
                     ->view('emails.send_project')
                     ->with([
                         'link' => $this->project->download_link,
                         'messageText' => $this->messageText
                     ]);

        // Si fichier local, on peut aussi l’attacher
       // if (Storage::disk('public')->exists($this->project->file_path)) {
           // $mail->attach(storage_path('app/public/' . $this->project->file_path));
       // }

        return $mail;
    }
}
