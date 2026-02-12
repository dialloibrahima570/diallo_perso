<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectRequest;
use App\Models\TelechargerCV;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    // Télécharger un projet
    public function project(Request $request, $id)
    {
        $project = ProjectRequest::findOrFail($id);

        // Vérification du lien signé
        if (!$request->hasValidSignature()) {
            abort(403, 'Lien invalide ou expiré.');
        }

        // Lien externe (GitHub / Drive)
        if (filter_var($project->file_path, FILTER_VALIDATE_URL)) {
            return redirect()->away($project->file_path);
        }

        // Fichier local
        if (!Storage::disk('public')->exists($project->file_path)) {
            abort(404, 'Fichier projet introuvable.');
        }

        return Storage::disk('public')->download($project->file_path); // ✅ Force téléchargement
    }

    // Télécharger un CV
    public function cv(Request $request, $id)
    {
        $cv = TelechargerCV::findOrFail($id);

        if (!$request->hasValidSignature()) {
            abort(403, 'Lien invalide ou expiré.');
        }

        if (filter_var($cv->file_path, FILTER_VALIDATE_URL)) {
            return redirect()->away($cv->file_path);
        }

        if (!Storage::disk('public')->exists($cv->file_path)) {
            abort(404, 'CV introuvable.');
        }

        return Storage::disk('public')->download($cv->file_path);
    }
}
