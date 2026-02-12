<?php

namespace App\Http\Controllers\Admin;
use App\Mail\ReplyContactMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        // accès uniquement si connecté
        $this->middleware('auth');
    }

    /**
     * Liste des messages contact (dashboard admin)
     */
    public function index(Request $request)
    {
        // ====== STATS (cards) ======
        $totalMessages  = Contact::count();
        $readMessages   = Contact::where('status', 'read')->count();
        $unreadMessages = Contact::where('status', 'unread')->count();

        // ====== QUERY PRINCIPALE ======
        $query = Contact::query();

        // Filtre par statut (?status=read / unread)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Recherche (?search=...)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%");
            });
        }

        // ====== PAGINATION (IMPORTANT) ======
        $contacts = $query->latest()->paginate(10);

        return view('admin.contact.index', compact(
            'contacts',
            'totalMessages',
            'readMessages',
            'unreadMessages'
        ));
    }

    /**
     * Voir un message
     */
    public function show(Contact $contact)
    {
        // Marquer comme lu automatiquement
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Supprimer un message
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Message supprimé avec succès');
    }



     // Répondre au message
    // Répondre au message
public function reply(Request $request, Contact $contact)
{
    // Validation
    $validated = $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Forcer un tableau pour Laravel 12+
    $data = [
        'subject' => $validated['subject'] ?? '',
        'message' => $validated['message'] ?? '',
        'name'    => $contact->name, // pour salutation
    ];

    try {
        // Envoi du mail
        Mail::to($contact->email)->send(new ReplyContactMail($data));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erreur lors de l\'envoi du mail : ' . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Réponse envoyée avec succès !');
}

}
