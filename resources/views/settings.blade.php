@extends('admin.layout')

@section('title', 'Paramètres')

@section('content')
<h2 style="color:var(--red); margin-bottom:30px;">Paramètres du Dashboard</h2>

<form method="POST" action="{{ route('settings.update') }}">
    @csrf


    <div class="settings-grid" style="display:grid; grid-template-columns:1fr; gap:30px; max-width:800px;">

        <!-- Notifications -->
        <div class="p-5 card" style="border-radius:15px; box-shadow:0 6px 20px rgba(0,0,0,0.08);">
            <h3>Notifications</h3>
            <p>Choisis quelles notifications tu veux recevoir.</p>
            <label class="switch">
                <input type="checkbox" name="notifications" {{ $userSettings->notifications ? 'checked' : '' }}>
                <span class="slider round"></span>
                Activer les notifications
            </label>

            <div style="margin-top:15px; display:flex; flex-wrap:wrap; gap:15px;">
                <label>
                    <input type="checkbox" name="notification_types[]" value="cv"
                        {{ in_array('cv', $userSettings->notification_types ?? []) ? 'checked' : '' }}>
                    Notifications CV
                </label>
                <label>
                    <input type="checkbox" name="notification_types[]" value="projects"
                        {{ in_array('projects', $userSettings->notification_types ?? []) ? 'checked' : '' }}>
                    Notifications Projets
                </label>
                <label>
                    <input type="checkbox" name="notification_types[]" value="messages"
                        {{ in_array('messages', $userSettings->notification_types ?? []) ? 'checked' : '' }}>
                    Notifications Messages
                </label>
            </div>
        </div>

        <!-- Apparence / Thème -->
        <div class="p-5 card" style="border-radius:15px; box-shadow:0 6px 20px rgba(0,0,0,0.08);">
            <h3>Apparence</h3>
            <label class="switch" style="margin-top:10px;">
                <input type="checkbox" name="dark_mode" {{ $userSettings->dark_mode ? 'checked' : '' }}>
                <span class="slider round"></span>
                Mode sombre
            </label>

            <div style="margin-top:15px; display:flex; align-items:center; gap:10px;">
                <label>Couleur principale:</label>
                <input type="color" name="theme_color" value="{{ $userSettings->theme_color ?? '#e63946' }}"
                    style="height:35px; width:55px; border:none; cursor:pointer;">
            </div>
        </div>

        <!-- Préférences générales -->
        <div class="p-5 card" style="border-radius:15px; box-shadow:0 6px 20px rgba(0,0,0,0.08);">
            <h3>Préférences générales</h3>
            <label style="display:flex; align-items:center; gap:10px; margin-top:10px;">
                Langue:
                <select name="language" class="form-select" style="padding:6px 12px; border-radius:8px;">
                    <option value="fr" {{ $userSettings->language == 'fr' ? 'selected' : '' }}>Français</option>
                    <option value="en" {{ $userSettings->language == 'en' ? 'selected' : '' }}>English</option>
                </select>
            </label>

            <label style="display:flex; align-items:center; gap:10px; margin-top:10px;">
                Fuseau horaire:
                <select name="timezone" class="form-select" style="padding:6px 12px; border-radius:8px;">
                    <option value="UTC" {{ $userSettings->timezone == 'UTC' ? 'selected' : '' }}>UTC</option>
                    <option value="Europe/Paris" {{ $userSettings->timezone == 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                    <option value="America/New_York" {{ $userSettings->timezone == 'America/New_York' ? 'selected' : '' }}>New York</option>
                </select>
            </label>
        </div>

        <!-- Bouton d'enregistrement -->
        <div>
            <button type="submit" class="btn btn-approve"
                style="padding:12px 25px; border-radius:10px; font-weight:600; background:var(--red); color:#fff;">
                Enregistrer les paramètres
            </button>
        </div>

    </div>
</form>

<!-- Styles du switch -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 25px;
}
.switch input { display:none; }
.slider {
  position: absolute;
  cursor: pointer;
  top:0;
  left:0;
  right:0;
  bottom:0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 25px;
}
.slider:before {
  position: absolute;
  content:"";
  height: 21px;
  width: 21px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider { background-color: var(--red); }
input:checked + .slider:before { transform: translateX(25px); }
</style>

@endsection
