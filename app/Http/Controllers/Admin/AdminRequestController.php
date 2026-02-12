<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectRequest;
use App\Models\TelechargerCV;
use App\Models\History;
use App\Mail\StatusUpdateMail;
use App\Mail\SendProjectMail;
use App\Mail\SendCVMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Page principale
     */
    public function index()
    {
        $totalProjects   = ProjectRequest::count();
        $pendingProjects = ProjectRequest::where('status', 'pending')->count();

        $totalCVs   = TelechargerCV::count();
        $pendingCVs = TelechargerCV::where('status', 'pending')->count();

        $projectRequests = ProjectRequest::latest()->paginate(10);
        $cvRequests      = TelechargerCV::latest()->paginate(10);

        return view('admin.requests.index', compact(
            'totalProjects', 'pendingProjects',
            'totalCVs', 'pendingCVs',
            'projectRequests', 'cvRequests'
        ));
    }

    /**
     * Détails projet
     */
    public function showProject($id)
    {
        $project = ProjectRequest::findOrFail($id);
        return view('admin.requests.show_project', compact('project'));
    }

    /**
     * Détails CV
     */
    public function showCV($id)
    {
        $cv = TelechargerCV::findOrFail($id);
        return view('admin.requests.show_cv', compact('cv'));
    }

    /**
     * Update statut projet
     */
    public function updateProjectStatus(Request $request, $id)
    {
        $project = ProjectRequest::findOrFail($id);
        $project->status = $request->status;
        $project->save();

        History::create([
            'request_item_id' => $project->id,
            'action'          => $project->status,
            'email'           => $project->email,
            'type'            => 'project',
            'message'         => $project->message
        ]);

        Mail::to($project->email)->send(new StatusUpdateMail($project, $project->status));

        return response()->json(['success' => true]);
    }

    /**
     * Update statut CV
     */
    public function updateCVStatus(Request $request, $id)
    {
        $cv = TelechargerCV::findOrFail($id);
        $cv->status = $request->status;
        $cv->save();

        History::create([
            'request_item_id' => $cv->id,
            'action'          => $cv->status,
            'email'           => $cv->email,
            'type'            => 'cv',
            'message'         => $cv->message
        ]);

        Mail::to($cv->email)->send(new StatusUpdateMail($cv, $cv->status));

        return response()->json(['success' => true]);
    }

    /**
     * ENVOI PROJET — PROBLÈME RÉGLÉ ICI
     */
 // ENVOI PROJET
    public function sendProject(Request $request, $id)
    {
        $project = ProjectRequest::findOrFail($id);

        // Nom du projet basé sur le nom affiché
        $projectSlug = Str::slug($project->project);

        // 1️⃣ SI LIEN EXTERNE
        if ($request->filled('project_link')) {
            $project->file_path = $request->project_link;
        }
        // 2️⃣ SINON → fichier local
        else {
            $files = Storage::disk('public')->files('projects');
            $matchedFile = collect($files)->first(function ($file) use ($projectSlug) {
                return Str::startsWith(basename($file), $projectSlug);
            });

            if (!$matchedFile) {
                return back()->with('error', 'Aucun fichier trouvé pour ce projet.');
            }

            $project->file_path = $matchedFile;
        }

        $project->save();

        $message = $request->input('message');

        Mail::to($project->email)->send(
            new SendProjectMail($project, $project->file_path, $message)
        );

        return back()->with('success', 'Projet envoyé avec succès ✅');
    }
    /**
     * ENVOI CV (un seul CV)
     */
    public function sendCV(Request $request, $id)
    {
        $cv = TelechargerCV::findOrFail($id);

        if ($request->filled('cv_link')) {
            $cv->file_path = $request->cv_link;
        } else {
            $cv->file_path = 'cvs/mon-cv.pdf';
        }

        $cv->save();

        $message = $request->input('message');

        Mail::to($cv->email)->send(
            new SendCVMail($cv, $cv->file_path, $message)
        );

        return back()->with('success', 'CV envoyé avec succès ✅');
    }
}
