@extends('admin.layout')

@section('title', 'Mon CV')

@section('content')
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1 id="mon">Mon CV</h1>
    <a href="#" class="btn btn-danger">
        <i class="bi bi-plus"></i> Modifier
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
#mon{
    color: #da0303;
    font-size:25px;

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

/* ===== Cartes ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-bottom:30px;
}
.card-box{
  background:var(--card);
  border-radius:18px;
  padding:22px;
  box-shadow:0 8px 20px rgba(0,0,0,.08);
  margin-bottom:24px;
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
    font-size: 20px;
    margin: 8px 0;
    flex: 1;
    text-align: center;   /* centrer le titre */
}

.header .menu-btn {
    font-size: 24px;
    cursor: pointer;
    background: rgb(181, 46, 46);
    border: none;
    color: #e3dfdf;

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

.badge-skill{
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
            <p>Étudiant en informatique</p>
            <p class="text-muted small">Developpeur Web & Mobile</p>
            <p class="mb-1"> <i class="bi bi-envelope"></i>ibrahima570@gmail.com</p>
            <p class="mb-0"> <i class="bi bi-geo-alt"></i>tunisie</p>
        </div>
    </div>

    <!-- Cartes dynamiques -->
<!-- RESUME -->
<div class="card-box">
    <h5 class="text-danger mb-3">Résumé professionnel</h5>
    <p class="text-muted">
        Développeur passionné spécialisé en développement web et applications,<br>
        avec une expérience dans Laravel, PHP, HTML, CSS et bases de données.<br>
        Orienté solutions, sécurité et performance.
    </p>
</div>

<!-- COMPETENCES -->
<div class="card-box">
    <h5 class="text-danger mb-3">Compétences</h5>
    <span class="badge-skill">HTML / CSS</span>
    <span class="badge-skill">Bootstrap</span>
    <span class="badge-skill">PHP</span>
    <span class="badge-skill">Laravel</span>
    <span class="badge-skill">MySQL</span>
    <span class="badge-skill">Git / GitHub</span>
</div>

<!-- EXPERIENCES -->
<div class="card-box">
    <h5 class="text-danger mb-3">Expériences</h5>

    <div class="timeline-item">
        <h6>Développeur Web – Projets personnels</h6>
        <small class="text-muted">2024 – Présent</small>
        <p class="text-muted mb-0">
            Développement de sites web dynamiques, dashboards administrateurs,
            systèmes sécurisés d’accès aux projets et CV.
        </p>
    </div>

    <div class="timeline-item">
        <h6>Étudiant en Informatique de Gestion</h6>
        <small class="text-muted">Université de Jendouba</small>
        <p class="text-muted mb-0">
            Algorithmique, structures de données, bases de données, web.
        </p>
    </div>
</div>

<!-- FORMATION -->
<div class="card-box">
    <h5 class="text-danger mb-3">Formations</h5>

    <div class="timeline-item">
        <h6>Licence Informatique de Gestion</h6>
        <small class="text-muted">Université de Jendouba</small>
    </div>

    <div class="timeline-item">
        <h6>Auto-formation Web & Mobile</h6>
        <small class="text-muted">Laravel – PHP – HTML – CSS</small>
    </div>
</div>

<!-- TELECHARGEMENT -->
<div class="card-box text-center">
    <button class="btn btn-danger btn-lg rounded-pill">
        <i class="bi bi-download"></i> Télécharger le CV
    </button>
    <p class="text-muted mt-2 small">
        Téléchargement sécurisé après validation
    </p>
</div>


</div>

@endsection
