<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\RequestItem;
use App\Mail\RequestProcessedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Statistique;
use App\Models\Contact; // en haut du fichier


class DashboardController extends Controller
{
    /**
     * Appliquer le middleware auth pour protéger le dashboard
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affichage du dashboard
     */
    public function index()
    {
        // --------------------------
        // Notifications
        // --------------------------
        $notifications = Notification::orderBy('created_at', 'desc')->get();
        $unreadCount = Notification::where('read', false)->count();

        // --------------------------
        // Statistiques des demandes
        // --------------------------
        $totalRequests = RequestItem::count();
        $cvRequests = RequestItem::where('type', 'cv')->count();
        $projectRequests = RequestItem::where('type', 'project')->count();
        $pendingRequests = RequestItem::where('status', 'pending')->count();
        $statistique = Statistique::first();
        $totalMessages  = Contact::count();
        $readMessages   = Contact::where('status', 'read')->count();
        $unreadMessages = Contact::where('status', 'unread')->count();

        // --------------------------
        // Liste complète pour le tableau
        // --------------------------
        $requestItems = RequestItem::where('status', 'pending')->orderBy('created_at', 'desc')->get();

            // --------------------------
// Données pour Graphiques
// --------------------------
        $chartRequests = [
        'cv' => $cvRequests,
        'project' => $projectRequests,
        'pending' => $pendingRequests,
    ];

          $chartMessages = [
             'read' => $readMessages,
            'unread' => $unreadMessages,
    ];


        // Envoi des données à la vue
        return view('dashboard', compact(
            'notifications',
            'unreadCount',
            'totalRequests',
            'cvRequests',
            'totalMessages',
            'readMessages',
            'unreadMessages',
            'projectRequests',
            'pendingRequests',
            'requestItems',
            'statistique',
            'chartRequests',
         'chartMessages',

        ));
    }





}
