<?php

namespace App\Observers;

use App\Models\ProjectRequest;
use App\Models\RequestItem;
use App\Models\Notification;

class ProjectRequestObserver
{
    // Cette fonction se déclenche quand un ProjectRequest est créé
    public function created(ProjectRequest $projectRequest)
    {
        RequestItem::create([
            'type' => 'project',
            'name' => $projectRequest->name,
            'email' => $projectRequest->email,
            'project_name' => $projectRequest->project_name,
            'message' => $projectRequest->message,
            'status' => 'pending',
        ]);
        Notification::create([
    'type' => 'project', // ici tu précises le type
    'message' => "Nouvelle demande de projet de {$projectRequest->name}",
    'read' => false,
]);

    }

    // Les autres méthodes (pas encore utilisées)
    public function updated(ProjectRequest $projectRequest): void
    {
        //
    }

    public function deleted(ProjectRequest $projectRequest): void
    {
        //
    }

    public function restored(ProjectRequest $projectRequest): void
    {
        //
    }

    public function forceDeleted(ProjectRequest $projectRequest): void
    {
        //
    }
}
