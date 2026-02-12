@extends('admin.layout')

@section('title', 'À propos')

@section('content')
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>A Propos de moi</h1>
    <a href="#" class="btn btn-danger">
        <i class="bi bi-plus"></i> Nouveau projet
    </a>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher un projet...">
        <div id="searchResults"></div>
    </div>


</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
:root{
  --bg:#f4f6f9;
  --card:#ffffff;
  --red:#e63946;
  --text:#1f2933;
  --muted:#6b7280;
  --border:#e5e7eb;
  --hover-shadow:0 12px 20px rgba(0,0,0,.12);
}

.main-section{
    background: var(--bg);
    padding: 20px;
}

/* ===== Profil ===== */
.profile-card{
    display:flex;
    align-items:center;
    gap:20px;
    background:var(--card);
    border-radius:20px;
    padding:24px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    margin-bottom:30px;
}
.profile-photo{
    width:100px;
    height:100px;
    border-radius:50%;
    background:#e5e7eb;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;
    color:#999;
}
.profile-info h2{
    margin:0;
    color:var(--red);
}
.profile-info p{
    margin:6px 0;
    color:var(--muted);
}

.header {
    display: flex;
    flex-wrap: wrap;      /* les éléments passent à la ligne si écran petit */
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: linear-gradient(135deg, #efecec, #dadada, #e2e2e2);
    color: #fff;
    border-radius: 10px;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 25px;
    margin: 8px 0;
    flex: 1;
    text-align: center;
    color: rgb(181, 46, 46);  /* centrer le titre */
}

.header .menu-btn {
    font-size: 24px;
    cursor: pointer;
    background: rgb(181, 46, 46);
    border: none;
    color: #e3dfdf;

}

/* ===== Cartes ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-bottom:30px;
}
.card{
    background:var(--card);
    border-radius:18px;
    padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,.06);
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
    transition:0.3s;
}
.card:hover{transform:translateY(-5px);box-shadow:var(--hover-shadow);}
.card i{font-size:28px;color:var(--red);margin-bottom:10px;}
.card h3{margin:0;font-size:16px;color:var(--red);}
.card p{margin:8px 0 0;font-size:14px;color:var(--text);}

/* ===== Sections ===== */
.section{
    background: var(--card);
    border-radius: 20px;
    padding: 24px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    margin-bottom: 24px;
}

.section h4{
    color: var(--red);
    margin-bottom:16px;
}

.timeline-item{
    border-left: 4px solid var(--red);
    padding-left:16px;
    margin-bottom:16px;
}

.timeline-item h6{
    margin:0;
    color: var(--red);
}

.tag{
    display:inline-block;
    background:rgba(230,57,70,.12);
    color:var(--red);
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
    margin:4px;
}
</style>

<div class="main-section">

    <!-- Profil -->
     <!-- Profil dynamique -->
    <div class="profile-card">
        <div class="profile-photo">
            @if(Auth::user()->photo)
                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profil" style="width:100px;height:100px;border-radius:50%;">
            @else
                👤
            @endif
        </div>
        <div class="profile-info">
            <h2>{{ Auth::user()->name }}</h2>
            <p>{{ Auth::user()->role ?? 'Étudiant en informatique de gestion' }}</p>
            <p class="text-muted small">
                {{ Auth::user()->description ?? 'Passionné par le développement web avec Laravel et la sécurité des applications.' }}
            </p>
        </div>
    </div>

    <!-- Cartes dynamiques -->
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

    <!-- Profil texte -->
    <div class="section">
        <h4>À propos de moi</h4>
        <p class="text-muted">
            {{ Auth::user()->bio ?? 'Je suis étudiant en informatique de gestion, spécialisé dans le développement web avec Laravel et la sécurité des applications. Passionné par la création de plateformes performantes et sécurisées.' }}
        </p>
    </div>

    <!-- Le reste reste inchangé... -->



    <!-- Profil texte -->
    <div class="section">
        <h4>À propos de moi</h4>
        <p class="text-muted">
            Je suis étudiant en informatique de gestion, spécialisé dans le développement web avec Laravel et la sécurité des applications.
            Passionné par la création de plateformes performantes et sécurisées.
        </p>
    </div>

    <!-- Parcours -->
    <div class="section">
        <h4>Parcours</h4>
        <div class="timeline-item">
            <h6>2025 — Développement Laravel avancé</h6>
            <p class="text-muted small">Création de dashboards, systèmes de demandes, accès privé, sécurité.</p>
        </div>
        <div class="timeline-item">
            <h6>2024 — Projets Web & E-commerce</h6>
            <p class="text-muted small">Sites vitrines, boutiques en ligne, gestion produits et commandes.</p>
        </div>
        <div class="timeline-item">
            <h6>2023 — Début développement</h6>
            <p class="text-muted small">HTML, CSS, C, VB.NET, bases du web.</p>
        </div>
    </div>

    <!-- Compétences -->
    <div class="section">
        <h4>Compétences</h4>
        <span class="tag">HTML</span>
        <span class="tag">CSS</span>
        <span class="tag">Bootstrap</span>
        <span class="tag">Laravel</span>
        <span class="tag">PHP</span>
        <span class="tag">MySQL</span>
        <span class="tag">Sécurité Web</span>
    </div>

    <!-- Valeurs -->
    <div class="section">
        <h4>Valeurs</h4>
        <ul class="text-muted">
            <li>✔️ Travail propre et structuré</li>
            <li>✔️ Sécurité et confidentialité</li>
            <li>✔️ Respect des utilisateurs</li>
            <li>✔️ Apprentissage continu</li>
        </ul>
    </div>

</div>

@endsection
