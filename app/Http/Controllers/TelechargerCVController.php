<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelechargerCV;

class TelechargerCVController extends Controller
{
    // Formulaire public
    public function create()
    {
        return view('telecharger_cv.create');
    }

    // Sauvegarde la demande
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'nullable|string',
        ]);

        TelechargerCV::create($request->only('name', 'email', 'message'));

        return back()->with('success', 'Votre demande de téléchargement du CV a été envoyée  veuillez patienter! ✅');
    }

    // Dashboard admin pour gérer les demandes
    public function index()
    {
        $requests = TelechargerCV::latest()->paginate(10);
        return view('admin.telecharger_cv.index', compact('requests'));
    }

    // Autoriser le téléchargement
    public function approve(TelechargerCV $request)
    {
        $request->update(['approved' => true]);
        return back()->with('success', 'Accès au CV autorisé !');
    }

    // Télécharger le CV (si autorisé)
    public function download(TelechargerCV $request)
    {
        if (!$request->approved) {
            return back()->with('error', 'Vous n’êtes pas autorisé à télécharger le CV.');
        }

        $filePath = public_path('resume.pdf'); // chemin vers ton CV
        return response()->download($filePath);
    }
}
