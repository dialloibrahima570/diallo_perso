@extends('admin.layout')

@section('title', 'Gestion des Projets')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root{
  --bg:#f4f6f9;
  --sidebar:#ffffff;
  --card:#ffffff;
  --red:#e63946;
  --text:#1f2933;
  --muted:#6b7280;
  --border:#e5e7eb;
  --soft:#fde8ea;
}

body{ margin:0; font-family:Segoe UI,Arial,sans-serif; background:var(--bg); color:var(--text); }

/* ===== MAIN ===== */
.main{ margin-left:220px; padding:24px; }

/* ===== HEADER ===== */
.header{ display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:20px; }
.header h1{ margin:0; color:var(--red); }

/* ===== STATS ===== */
.stats-row{ display:flex; align-items:flex-start; gap:20px; margin-bottom:30px; }
.stat-card{ background:linear-gradient(135deg,#fff,#fde8ea); border-radius:18px; padding:18px; box-shadow:0 6px 15px rgba(0,0,0,.06); flex:1; }
.stat-card h6{ margin:0; font-size:13px; color:var(--muted); }
.stat-card p{ margin:8px 0 0; font-size:28px; font-weight:bold; color:var(--red); }
#projectsChartContainer{ background:var(--card); border-radius:18px; padding:18px; box-shadow:0 6px 15px rgba(0,0,0,.06); flex:2; }

/* ===== FEATURED ===== */
.featured{ background:var(--card); border-radius:20px; padding:22px; box-shadow:0 8px 20px rgba(0,0,0,.08); }
.featured-img{ background:#e5e7eb; border-radius:16px; height:220px; display:flex; align-items:center; justify-content:center; color:#999; }
.tag{ background:var(--soft); color:var(--red); padding:6px 12px; border-radius:20px; font-size:12px; font-weight:600; margin-right:8px; }

/* ===== PROJECT CARD ===== */
.project-card{ background:var(--card); border-radius:18px; box-shadow:0 6px 15px rgba(0,0,0,.06); overflow:hidden; transition:.3s; position:relative; }
.project-card:hover{ transform:translateY(-6px); box-shadow:0 14px 24px rgba(0,0,0,.12); }
.project-image{ height:160px; display:flex; align-items:center; justify-content:center; color:#999; font-weight:bold; font-size:16px; }
.project-body{ padding:18px; }
.project-body h5{ margin:0 0 6px; color:var(--red); }
.project-body p{ font-size:14px; color:var(--muted); }
.project-meta{ font-size:13px; color:var(--muted); }


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
/* ===== TIMELINE ===== */
.timeline-item{ background:var(--card); border-left:5px solid var(--red); padding:16px 20px; margin-bottom:14px; border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,.06); }
.timeline-item h6{ margin:0; color:var(--red); }

/* ===== RESPONSIVE ===== */
@media(max-width:768px){ .sidebar{left:-220px;} .main{margin-left:0;} .stats-row{flex-direction:column;} }
</style>

{{-- HEADER --}}
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>Gestion des Projets</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-danger">
        <i class="bi bi-plus"></i> Nouveau projet
    </a>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher un projet...">
        <div id="searchResults"></div>
    </div>
</div>

{{-- STAT + GRAPHIQUE --}}
<div class="stats-row">
    <div class="stat-card">
        <h6>Total projets</h6>
        <p id="total-projects">{{ $totalProjects }}</p>
    </div>
    <div id="projectsChartContainer">
        <canvas id="projectsChart" height="120"></canvas>
    </div>
</div>

{{-- PROJET VEDETTE --}}
@if($featuredProject)
<div class="mb-5 featured">
    <div class="row g-4 align-items-center">
        <div class="col-md-6">
            <div class="featured-img">
               <img src="{{ $featuredProject->image
    ? asset('storage/'.$featuredProject->image)
    : asset('images/default-project.png') }}"
     alt="{{ $featuredProject->name }}"
     style="width:100%;height:220px;object-fit:cover;">

            </div>
        </div>
        <div class="col-md-6">
            <h3 class="text-danger">{{ $featuredProject->name }}</h3>
            <p class="text-muted">{{ $featuredProject->description ?? 'Pas de description' }}</p>
            <div class="mb-3">
                @foreach(explode(',', $featuredProject->technos) as $tech)
                    <span class="tag">{{ $tech }}</span>
                @endforeach
            </div>
            <div class="mt-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-primary rounded-pill me-2">Voir détails</button>
                <button class="btn btn-sm btn-outline-danger rounded-pill delete-project"
                    data-date="{{ \Carbon\Carbon::parse($featuredProject->date)->format('Y-m-d H:i:s') }}">
                    Supprimer
                </button>
                <button class="text-white btn btn-warning rounded-pill">Lien privé</button>
            </div>
        </div>
    </div>
</div>
@endif

{{-- CARDS PROJETS --}}
<div class="row g-4">
@foreach($projects as $project)
<div class="col-md-4">
    <div class="project-card">
        <div class="project-image">
           <img src="{{ $project->image
    ? asset('storage/'.$project->image)
    : asset('images/default-project.png') }}"
     alt="{{ $project->name }}"
     style="width:100%;height:160px;object-fit:cover;">

        </div>
        <div class="project-body">
            <h5>{{ $project->name }}</h5>
            <p class="text-muted small">{{ $project->description ?? '' }}</p>
            <div class="project-meta">
                📅 {{ \Carbon\Carbon::parse($project->date)->year }} · {{ $project->type ?? 'Web' }}
            </div>
            <div class="mt-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-sm btn-outline-primary rounded-pill">Détails</button>
                <button class="btn btn-sm btn-outline-danger rounded-pill delete-project"
                    data-date="{{ \Carbon\Carbon::parse($project->date)->format('Y-m-d H:i:s') }}">
                    Supprimer
                </button>
                <button class="btn btn-sm btn-outline-warning rounded-pill">Privé</button>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>

{{-- TIMELINE --}}
<div class="mt-5">
    <h4 class="mb-3 text-danger">Historique des projets</h4>
    @foreach($projects->sortByDesc('date') as $project)
    <div class="timeline-item" data-project-date="{{ \Carbon\Carbon::parse($project->date)->format('Y-m-d H:i:s') }}">
        <h6>{{ \Carbon\Carbon::parse($project->date)->format('Y') }} — {{ $project->name }}</h6>
        <p class="mb-0 text-muted small">{{ $project->description ?? '' }}</p>
    </div>
    @endforeach
</div>

@endsection

@section('scripts')
<script>
document.getElementById('searchInput').addEventListener('input', function() {
    let query = this.value.toLowerCase();
    document.querySelectorAll('.project-card, .timeline-item').forEach(card => {
        card.style.display = card.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
});

// Graphique
const ctx2 = document.getElementById('projectsChart').getContext('2d');
window.projectsChart = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Projets par année',
            data: {!! json_encode($chartData) !!},
            borderColor: 'rgba(230,57,70,1)',
            backgroundColor: 'rgba(230,57,70,0.2)',
            fill:true,
            tension:0.4,
            pointRadius:4,
            pointBackgroundColor:'rgba(230,57,70,1)'
        }]
    },
    options:{
        responsive:true,
        plugins:{ legend:{display:false}, tooltip:{mode:'index', intersect:false} },
        scales:{ x:{grid:{display:false}}, y:{beginAtZero:true} }
    }
});

// Suppression Ajax
document.querySelectorAll('.delete-project').forEach(btn => {
    btn.addEventListener('click', function () {
        const projectDate = this.dataset.date;
        if (!confirm('Voulez-vous vraiment supprimer ce projet ?')) return;

        fetch('/admin/projects/delete-by-date', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ date: projectDate })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {

                // 1. Supprimer la card
                const card = btn.closest('.col-md-4');
                if(card){
                    card.style.transition = "opacity 0.5s, transform 0.5s";
                    card.style.opacity = 0;
                    card.style.transform = "translateY(-20px)";
                    setTimeout(() => card.remove(), 500);
                }

                // 2. Mettre à jour le compteur
                const total = document.getElementById('total-projects');
                if(total && data.totalProjects !== undefined){
                    total.innerText = data.totalProjects;
                }

                // 3. Mettre à jour le graphique
                if(window.projectsChart && data.chartLabels && data.chartData){
                    window.projectsChart.data.labels = data.chartLabels;
                    window.projectsChart.data.datasets[0].data = data.chartData;
                    window.projectsChart.update();
                }

                // 4. Supprimer de l'historique
                document.querySelectorAll('.timeline-item').forEach(item => {
                    if(item.dataset.projectDate === projectDate){
                        item.remove();
                    }
                });

                // 5. Toast
                const toast = document.createElement('div');
                toast.textContent = data.message;
                toast.style.cssText = `
                    position: fixed;
                    bottom: 20px;
                    right: 20px;
                    background: #e63946;
                    color: #fff;
                    padding: 12px 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                    z-index: 10000;
                    opacity: 0;
                    transition: opacity 0.5s;
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.style.opacity = 1, 50);
                setTimeout(() => { toast.style.opacity = 0; setTimeout(() => toast.remove(), 500); }, 2000);
            }
        })
        .catch(err => {
            console.error(err);
            alert('Erreur lors de la suppression du projet.');
        });
    });
});
</script>
@endsection
