<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Afficher les paramètres
    public function index()
    {
        $userSettings = UserSetting::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'notifications' => true,
                'notification_types' => ['cv', 'projects', 'messages'], // ⬅ ARRAY, PAS JSON
                'dark_mode' => false,
                'theme_color' => '#e63946',
                'language' => 'fr',
                'timezone' => 'UTC',
            ]
        );

        return view('settings', compact('userSettings'));
    }

    // Sauvegarder les paramètres
    public function update(Request $request)
    {
        $userSettings = UserSetting::where('user_id', Auth::id())->firstOrFail();

        $userSettings->update([
            'notifications' => $request->has('notifications'),
            'notification_types' => $request->input('notification_types', []), // ARRAY
            'dark_mode' => $request->has('dark_mode'),
            'theme_color' => $request->input('theme_color', '#e63946'),
            'language' => $request->input('language', 'fr'),
            'timezone' => $request->input('timezone', 'UTC'),
        ]);

        return back()->with('success', 'Paramètres enregistrés avec succès ✅');
    }
}
