<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{


    /**
     * Enregistrer un nouveau message depuis le formulaire contact
     */
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Sauvegarde dans la table contacts
        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Retour avec message de succès
        return back()->with('success', 'Message envoyé avec succès ! ✅');
    }
}
