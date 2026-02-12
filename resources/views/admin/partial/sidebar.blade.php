<div class="sidebar">
    <!-- Profil admin -->
    <div class="sidebar-profile">
       <img
    src="{{ Auth::user()->photo
        ? asset('storage/' . Auth::user()->photo)
        : asset('images/default-avatar.png') }}"
    class="avatar"
    alt="Profil">

        <h4>{{ auth()->user()->name ?? 'Admin' }}</h4>
    </div>

    <!-- Menu principal -->
    <a href="{{ route('dashboard') }}"><i class="bi bi-house"></i>Dashboard</a>
    <a href="{{ route('admin.requests.index') }}"><i class="bi bi-file-earmark-text"></i>Demandes</a>
    <a href="{{ route('profile.cv') }}"><i class="bi bi-person-badge"></i>CV</a>
    <a href="{{ route('admin.projects') }}"><i class="bi bi-folder2-open"></i>Projets</a>
    <a href="{{ route('admin.contact.index') }}"><i class="bi bi-envelope"></i>Contact</a>

    <a href="{{ route('admin.history') }}"> <i class="bi bi-clock-history"></i> Historique</a>

    <a href="{{ route('profile.about') }}"><i class="bi bi-info-circle"></i>À propos</a>
    <a href="{{ route('settings') }}"><i class="bi bi-gear"></i>Paramètres</a>

    <!-- Déconnexion -->
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-reject w-120">
        <i class="bi bi-box-arrow-right"></i> Déconnexion
    </button>
</form>

</div>
