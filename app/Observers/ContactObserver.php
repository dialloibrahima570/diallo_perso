<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\RequestItem;
use App\Models\Notification;

class ContactObserver
{
    public function created(Contact $contact)
    {
        // À la création d'un contact, on crée un RequestItem
        RequestItem::create([
            'type' => 'contact',
            'name' => $contact->name,
            'email' => $contact->email,
            'message' => $contact->message,
            'status' => 'pending',
        ]);

         // Crée aussi une notification pour l'admin
        Notification::create([
            'type' => 'contact',
            'message' => "Nouvelle demande de contact de {$contact->name}",
            'read' => false,
        ]);
    }
}
