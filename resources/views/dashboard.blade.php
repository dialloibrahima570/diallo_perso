@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>Bienvenue</h1>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher...">
        <div id="searchResults"></div>
    </div>
    <div class="notifications">
        <i class="bi bi-bell" id="notifIcon" style="font-size:24px;cursor:pointer;"></i>
        <span class="notif-badge" id="notifBadge">{{ $unreadCount }}</span>
        <div class="notif-dropdown" id="notifDropdown">
            @forelse($notifications as $notif)
                <div class="notif-item {{ $notif->read ? 'read' : 'unread' }}" data-id="{{ $notif->id }}">
                    {{ $notif->message }}
                </div>
            @empty
                <div class="notif-item">Aucune notification</div>
            @endforelse
        </div>
    </div>

    <div class="profile-menu">
          <img
    src="{{ Auth::user()->photo
        ? asset('storage/' . Auth::user()->photo)
        : asset('images/default-avatar.png') }}"
    class="avatar"
    alt="Profil" id="profileAvatar" >
        <div class="dropdown" id="profileDropdown">
            <a href="{{ route('profile.show') }}">Mon profil</a>
            <a href="{{ route('settings') }}">Paramètres</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    </div>
</div>

<h2 style="margin:25px 0 10px;color:var(--red);">Statistiques des demandes</h2>
<div class="cards">

    {{-- DEMANDES --}}
    <a href="{{ route('admin.requests.index') }}" class="card">
        <i class="bi bi-people-fill"></i>
        <h3>Total demandes</h3>
        <p>{{ $totalRequests }}</p>
    </a>

    <a href="{{ route('admin.requests.index', ['type' => 'cv']) }}" class="card">
        <i class="bi bi-file-earmark-person"></i>
        <h3>Demandes CV</h3>
        <p>{{ $cvRequests }}</p>
    </a>

    <a href="{{ route('admin.requests.index', ['type' => 'project']) }}" class="card">
        <i class="bi bi-folder2-open"></i>
        <h3>Demandes Projets</h3>
        <p>{{ $projectRequests }}</p>
    </a>

    <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}" class="card">
        <i class="bi bi-clock-history"></i>
        <h3>En attente</h3>
        <p>{{ $pendingRequests }}</p>
    </a>

    {{-- CONTACT --}}
    <a href="{{ route('admin.contact.index') }}" class="card">
        <i class="bi bi-chat-left-text"></i>
        <h3>Messages reçus</h3>
        <p>{{ $totalMessages}}</p>
    </a>

</div>


<h2 style="margin:25px 0 10px;color:var(--red);">Statistiques personnelles</h2>
<div class="cards">
    <div class="card">
        <i class="bi bi-calendar-check"></i>
        <h3>Années d’expérience</h3>
        <p>{{ $statistique->annees_experience }}</p>
    </div>
    <div class="card">
        <i class="bi bi-emoji-smile"></i>
        <h3>Clients satisfaits</h3>
        <p>{{ $statistique->clients_satisfaits }}</p>
    </div>
    <div class="card">
        <i class="bi bi-folder-check"></i>
        <h3>Projets réalisés</h3>
        <p>{{ $statistique->projets_realises }}</p>
    </div>
</div>


<div class="graph-section" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px;margin-top:30px;">

    <div class="graph-card" style="background:#fff;padding:20px;border-radius:16px;box-shadow:0 6px 15px rgba(0,0,0,.08);">
        <h2 style="margin-bottom:20px;">Demandes</h2>
        <canvas id="requestsChart"></canvas>
    </div>

    <div class="graph-card" style="background:#fff;padding:20px;border-radius:16px;box-shadow:0 6px 15px rgba(0,0,0,.08);">
        <h2 style="margin-bottom:20px;">Messages</h2>
        <canvas id="messagesChart"></canvas>
    </div>

</div>



@endsection

@section('scripts')
<script>
document.getElementById('searchInput').addEventListener('input', function() {
    let query = this.value;
    fetch(`/dashboard/search?query=${query}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('searchResults').innerHTML = html;
        });
});
</script>


<script>
const requestData = @json($chartRequests);
const messageData = @json($chartMessages);

// 📊 Graph 1 - Demandes
new Chart(document.getElementById('requestsChart'), {
    type: 'doughnut',
    data: {
        labels: ['CV', 'Projets', 'En attente'],
        datasets: [{
            data: [
                requestData.cv,
                requestData.project,
                requestData.pending
            ],
            backgroundColor: [
                '#dc2626',
                '#2563eb',
                '#f59e0b'
            ]
        }]
    }
});

// 📈 Graph 2 - Messages
new Chart(document.getElementById('messagesChart'), {
    type: 'bar',
    data: {
        labels: ['Lus', 'Non lus'],
        datasets: [{
            label: 'Messages',
            data: [
                messageData.read,
                messageData.unread
            ],
            backgroundColor: ['#16a34a', '#dc2626']
        }]
    }
});
</script>

@endsection

<style>
/* DASHBOARD MOBILE */
.dashboard-mobile {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.dashboard-card {
    background: #fff;
    padding: 15px;
    border-radius: 14px;
    box-shadow: 0 6px 15px rgba(0,0,0,.08);
}
.dashboard-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.dashboard-email, .dashboard-type {
    margin: 8px 0 4px;
    word-break: break-word;
    font-size: 14px;
    color: var(--muted);
}

/* DESKTOP */
.dashboard-desktop { display: block; }
@media (max-width: 768px) {
    .dashboard-desktop { display: none; } /* cache table sur mobile */
}
@media (min-width: 768px) {
    .dashboard-mobile { display: none; } /* cache cards sur PC */
}


/* =========================
   CARDS DASHBOARD
========================= */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.cards a.card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none; /* enlève le soulignement */
    background: #fff;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-align: center;
    color: #1f2937;
}

.cards a.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.12);
}

.cards a.card i {
    font-size: 28px;
    color: #dc2626; /* rouge par défaut */
    margin-bottom: 10px;
}

.cards a.card h3 {
    font-size: 14px;
    margin: 5px 0;
    color: #dc2626; /* rouge titre */
    font-weight: 600;
}

.cards a.card p {
    font-size: 28px;
    font-weight: bold;
    color: #1f2937;
    margin: 0;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
    .cards {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 15px;
    }
    .cards a.card p {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .cards {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .cards a.card p {
        font-size: 22px;
    }
}

</style>
