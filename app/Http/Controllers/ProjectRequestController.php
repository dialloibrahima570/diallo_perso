<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectRequest;

class ProjectRequestController extends Controller
{
    // Formulaire public pour créer une demande
    public function create($project)
    {
        return view('admin.project_requests.create', compact('project'));
    }

    // Sauvegarde la demande depuis le formulaire public
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'project' => 'required|string',
            'message' => 'required|string',
            'type'    => 'required|in:project,cv', // ajout de la validation pour le type
        ]);

        ProjectRequest::create($request->only('name', 'email', 'project', 'message', 'type')); // ajout de type

        return back()->with('success', 'Votre demande a été envoyée ! ✅');
    }

    // Page “Demandes” pour l’admin (tableau complet)
    public function index()
    {
        $requestItems = ProjectRequest::whereNull('status')->latest()->paginate(10);
        $totalRequests = ProjectRequest::count();
        $cvRequests = ProjectRequest::where('type', 'cv')->count();
        $projectRequests = ProjectRequest::where('type', 'project')->count();
        $pendingRequests = ProjectRequest::whereNull('status')->count(); // en attente

        return view('admin.project_requests.index', compact(
            'requestItems',
            'totalRequests',
            'cvRequests',
            'projectRequests',
            'pendingRequests'
        ));
    }

    // Accepter ou refuser une demande
    public function updateStatus(ProjectRequest $requestItem, $status)
    {
        $requestItem->update(['status' => $status]);

        return response()->json([
            'success' => true,
            'status' => $status
        ]); // pour mise à jour AJAX
    }

    // Voir une demande en détail
    public function show(ProjectRequest $requestItem)
    {
        return view('admin.project_requests.show', compact('requestItem'));
    }
}
