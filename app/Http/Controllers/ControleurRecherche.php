<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\CV;


class ControleurRecherche extends Controller
{
    // Recherche sur la page principale
    public function rechercher(Request $request)
    {
        $query = $request->input('query');

        $projets = Project::where('title', 'like', "%$query%")
                          ->orWhere('description', 'like', "%$query%")
                          ->get();

        $cvs = CV::where('name', 'like', "%$query%")
                 ->orWhere('email', 'like', "%$query%")
                 ->get();

        $resultats = [];

        foreach ($projets as $projet) {
            $resultats[] = [
                'type' => 'Projet',
                'titre' => $projet->title,
                'description' => $projet->description,
                'lien' => route('project.show', $projet->id)
            ];
        }

        foreach ($cvs as $cv) {
            $resultats[] = [
                'type' => 'CV',
                'titre' => $cv->name,
                'description' => $cv->message ?? '',
                'lien' => route('cv.show', $cv->id)
            ];
        }

        return view('partials.resultats', compact('resultats'));
    }

    // Recherche sur le dashboard (sécurisée)
    public function rechercherDashboard(Request $request)
    {
        $query = $request->input('query');

        $projets = Project::where('title', 'like', "%$query%")
                          ->orWhere('description', 'like', "%$query%")
                          ->get();

        $cvs = cv::where('name', 'like', "%$query%")
                 ->orWhere('email', 'like', "%$query%")
                 ->get();

        $resultats = [];

        foreach ($projets as $projet) {
            $resultats[] = [
                'type' => 'Projet',
                'titre' => $projet->title,
                'description' => $projet->description,
                'statut' => $projet->is_visible ? 'accessible' : 'restreint',
                'lien' => route('project.show', $projet->id)
            ];
        }

        foreach ($cvs as $cv) {
            $resultats[] = [
                'type' => 'CV',
                'titre' => $cv->name,
                'description' => $cv->message ?? '',
                'statut' => 'accessible',
                'lien' => route('cv.show', $cv->id)
            ];
        }

        return view('partials.resultats_dashboard', compact('resultats'));
    }
}
