<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Récupérer les notifications non lues
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();
        $unreadCount = Notification::where('read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }

    // Marquer comme lu
    public function markAsRead($id)
    {
        $notif = Notification::findOrFail($id);
        $notif->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}
