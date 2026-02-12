<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Statistique;

class ProfileController extends Controller
{
    /**
     * Affiche le formulaire du profil utilisateur.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Met à jour les informations du profil (nom, email, photo).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        /* =========================
           GESTION DE LA PHOTO
        ========================= */
        if ($request->hasFile('photo')) {

            // Supprimer l'ancienne photo
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Stocker la nouvelle photo
            $data['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        // Mise à jour des données utilisateur
        $user->fill($data);

        // Si l'email change, on invalide la vérification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.show')
            ->with('status', 'profile-updated');
    }

    /**
     * Supprime le compte utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Supprimer la photo si elle existe
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Page "À propos" sécurisée.
     */
    public function about()
    {
        $user = Auth::user();

        $statistique = $user->statistique ?? Statistique::first();
        $projects = Project::all();

        return view('profile.about', compact('user', 'statistique', 'projects'));
    }

    /**
     * Page CV sécurisée.
     */
    public function cv()
    {
        $user = Auth::user();

        return view('profile.cv', compact('user'));
    }
}
