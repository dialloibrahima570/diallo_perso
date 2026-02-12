<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RechercheController extends Controller
{
    public function ajaxRecherche(Request $request)
    {
        $mot = strtolower($request->get('q', ''));

        $elements = [
            ['label' => 'Accueil', 'url' => route('home') . '#home'],
            ['label' => 'À propos', 'url' => route('home') . '#about'],
            ['label' => 'Compétences', 'url' => route('home') . '#skills'],
            ['label' => 'Projets', 'url' => route('home') . '#projects'],
            ['label' => 'Contact', 'url' => route('home') . '#contact'],
            ['label' => 'E-commerce', 'url' => route('project.request.create', 'E-commerce')],
            ['label' => 'App Mobile', 'url' => route('project.request.create', 'App Mobile')],
            ['label' => 'Dashboard Admin', 'url' => route('project.request.create', 'Dashboard Admin')],
        ];

        $resultats = collect($elements)
            ->filter(fn($item) => str_contains(strtolower($item['label']), $mot))
            ->take(5) // limite les résultats
            ->values();

        return response()->json($resultats);
    }
}

