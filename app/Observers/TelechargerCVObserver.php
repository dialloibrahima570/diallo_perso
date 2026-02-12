<?php
namespace App\Observers;

use App\Models\TelechargerCV;
use App\Models\RequestItem;
use App\Models\Notification;

class TelechargerCVObserver
{
    public function created(TelechargerCV $cv)
    {
        RequestItem::create([
            'type' => 'cv',
            'name' => $cv->name,
            'email' => $cv->email,
            'message' => $cv->message,
            'status' => 'pending',
        ]);
        Notification::create([
    'type' => 'cv', // ici tu précises le type
    'message' => "Nouvelle demande de CV de {$cv->name}",
    'read' => false,
]);

    }
}
