@extends('admin.layout')

@section('title', 'Gestion des demandes')

@section('content')

{{-- HEADER IDENTIQUE AUX AUTRES PAGES --}}
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1  id="col">Demandes</h1>
    <div class="d-flex gap-2 mt-3 flex-wrap">
    <select id="statusFilter" class="form-select w-auto rounded-pill">
    <option value="">Toutes les demandes</option>
    <option value="pending">En attente</option>
    <option value="accepted">Projets acceptés</option>
    <option value="approved">CV acceptés</option>
    <option value="rejected">Refusées</option>
</select>

</div>

</div>

{{-- LIENS (déjà utilisés dans ton projet) --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

{{-- CSS : REPRISE EXACTE DU DESIGN CONTACTS + AJUSTEMENTS TABLE --}}
<style>
/* ===== DESIGN CONTACTS ===== */
.dashboard-container{
  max-width:1400px;
  margin:auto;
  padding:24px;
}
#col{
color: #d20505;
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

.header .d-flex {
    width: 100%;
    margin-top: 8px;
    flex-wrap: wrap;
}

.stats-cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:16px;
    margin-bottom:25px;
}
.stats-card{
    background:#fff;
    border-radius:16px;
    padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,.06);
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
}
.stats-card i{
    font-size:28px;
    color:#dc2626;
    margin-bottom:10px;
}
.stats-card h3{
    margin:0;
    font-size:14px;
    color:#dc2626;
}
.stats-card p{
    margin:10px 0 0;
    font-size:30px;
    font-weight:bold;
    color:#1f2937;
}

/* ===== TABLE CONTAINER ===== */
.card-box{
  background:#fff;
  border-radius:14px;
  border:1px solid #e5e7eb;
  margin-bottom:25px;
}

/* TITRES DES TABLES */
.table-title{
    padding:16px 18px;
    font-size:16px;
    font-weight:700;
    color:#ff0f0f;
    border-bottom:1px solid #e5e7eb;
}


/* ===== MOBILE CARDS (COMME CONTACTS) ===== */
.contacts-mobile {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 20px;
}

.contacts-mobile .contact-card {
    background: #fff;
    padding: 15px;
    border-radius: 14px;
    box-shadow: 0 6px 15px rgba(0,0,0,.08);
}

.contacts-mobile .contact-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.contacts-mobile .contact-name {
    font-weight: 600;
    margin-bottom: 4px;
}

.contacts-mobile .contact-email,
.contacts-mobile .contact-subject {
    font-size: 14px;
    color: #555;
    word-break: break-all;
}

/* cacher table sur mobile */
.table-responsive {
    display: none;
}

/* desktop */
@media (min-width: 768px) {
    .contacts-mobile { display: none; }
    .table-responsive { display: block; overflow-x: auto; }
}

/* THEAD STYLE (SANS MODIFIER HTML) */
.table thead th{
    background:#f3f3f3;
    color:#dc1b1b;
    font-size:13px;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.04em;
    border-bottom:1px solid #e5e7eb;
}

.badge-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

/* Statuts couleurs */
.badge-pending {
    background: #daaf21; /* jaune */
    color: #ffffff;
}

.badge-accepted,
.badge-approved {
    background: #048531; /* vert clair */
    color: #fefefe;
}

.badge-rejected {
    background: #d20505; /* rouge clair */
    color: #fbfbfb;
}


/* BOUTONS ACTIONS (IDENTIQUES CONTACTS) */
.action-btn{
  border-radius:50%;
  width:34px;
  height:34px;
  border:1px solid #e5e7eb;
  background:#fff;
}
.btn-view{color:#2563eb;}
.btn-delete{color:#dc2626;}
</style>

<div class="dashboard-container">

{{-- ================= STATS (DESIGN CONTACTS) ================= --}}
<div class="stats-cards">
    <div class="stats-card">
        <i class="bi bi-kanban"></i>
        <h3>Total projets</h3>
        <p>{{ $totalProjects }}</p>
    </div>

    <div class="stats-card">
        <i class="bi bi-hourglass-split"></i>
        <h3>Projets en attente</h3>
        <p>{{ $pendingProjects }}</p>
    </div>

    <div class="stats-card">
        <i class="bi bi-file-earmark-person"></i>
        <h3>Total CV</h3>
        <p>{{ $totalCVs }}</p>
    </div>

    <div class="stats-card">
        <i class="bi bi-clock-history"></i>
        <h3>CV en attente</h3>
        <p>{{ $pendingCVs }}</p>
    </div>
</div>

{{-- ================= TABLE PROJETS ================= --}}
<div class="card-box">


    <div class="table-title">Demandes de projets</div>
    {{-- MOBILE – DEMANDES PROJETS --}}
<div class="contacts-mobile">

@foreach($projectRequests as $project)
    <div class="contact-card">
        <div class="contact-row">
            <span class="badge-status
    {{ $project->status === 'pending' ? 'badge-pending' : ($project->status === 'accepted' ? 'badge-accepted' : ($project->status === 'rejected' ? 'badge-rejected' : 'badge-approved')) }}">
    {{ ucfirst($project->status) }}
</span>

            <small>{{ $project->created_at->format('d/m/Y') }}</small>
        </div>

        <div class="contact-name">{{ $project->name }}</div>
        <div class="contact-email">{{ $project->email }}</div>
        <div class="contact-subject">{{ $project->project }}</div>

        <div class="d-flex gap-2 mt-2">
            <a href="{{ route('admin.requests.project.show', $project->id) }}"
               class="btn btn-sm btn-view">
                <i class="bi bi-eye"></i> Voir
            </a>
        </div>
    </div>
@endforeach

</div>


    <div class="table-responsive p-3">

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Projet</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th width="140" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody   id="projectRequests">
            @forelse($projectRequests as $project)
            <tr id="project-{{ $project->id }}">
                <td>{{ $project->name }}</td>
                <td>{{ $project->email }}</td>
                <td>{{ $project->project }}</td>
                <td>{{ Str::limit($project->message, 40) }}</td>
                <td class="status">
                   <span class="badge-status
    {{ $project->status === 'pending' ? 'badge-pending' : ($project->status === 'accepted' ? 'badge-accepted' : ($project->status === 'rejected' ? 'badge-rejected' : 'badge-approved')) }}">
    {{ ucfirst($project->status) }}
</span>

                </td>
                <td class="text-end">
                    @if($project->status === 'pending')
                        <button class="action-btn btn-view approve-btn"
                            data-type="project" data-id="{{ $project->id }}">
                            <i class="bi bi-check-lg"></i>
                        </button>

                        <button class="action-btn btn-delete reject-btn"
                            data-type="project" data-id="{{ $project->id }}">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    @endif

                    <a href="{{ route('admin.requests.project.show', $project->id) }}"
                       class="action-btn btn-view">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    Aucune demande de projet
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>

        {{ $projectRequests->links() }}
    </div>
</div>

{{-- ================= TABLE CV ================= --}}
<div class="card-box">
    <div class="table-title">Demandes de CV</div>
{{-- MOBILE – DEMANDES CV --}}
<div class="contacts-mobile">

@foreach($cvRequests as $cv)
    <div class="contact-card">
        <div class="contact-row">
            <span class="badge-status
    {{ $cv->status === 'pending' ? 'badge-pending' : ($cv->status === 'approved' ? 'badge-accepted' : ($cv->status === 'rejected' ? 'badge-rejected' : 'badge-approved')) }}">
    {{ ucfirst($cv->status) }}
</span>

            <small>{{ $cv->created_at->format('d/m/Y') }}</small>
        </div>

        <div class="contact-name">{{ $cv->name }}</div>
        <div class="contact-email">{{ $cv->email }}</div>
        <div class="contact-subject">{{ Str::limit($cv->message, 40) }}</div>

        <div class="d-flex gap-2 mt-2">
            <a href="{{ route('admin.requests.cv.show', $cv->id) }}"
               class="btn btn-sm btn-view">
                <i class="bi bi-eye"></i> Voir
            </a>
        </div>
    </div>
@endforeach

</div>

    <div class="table-responsive p-3">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th width="140" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody   id="cvRequests">
            @forelse($cvRequests as $cv)
            <tr id="cv-{{ $cv->id }}">
                <td>{{ $cv->name }}</td>
                <td>{{ $cv->email }}</td>
                <td>{{ Str::limit($cv->message, 40) }}</td>
                <td class="status">
                   <span class="badge-status
    {{ $cv->status === 'pending' ? 'badge-pending' : ($cv->status === 'approved' ? 'badge-accepted' : ($cv->status === 'rejected' ? 'badge-rejected' : 'badge-approved')) }}">
    {{ ucfirst($cv->status) }}
</span>

                </td>
                <td class="text-end">
                    @if($cv->status === 'pending')
                        <button class="action-btn btn-view approve-btn"
                            data-type="cv" data-id="{{ $cv->id }}">
                            <i class="bi bi-check-lg"></i>
                        </button>

                        <button class="action-btn btn-delete reject-btn"
                            data-type="cv" data-id="{{ $cv->id }}">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    @endif

                    <a href="{{ route('admin.requests.cv.show', $cv->id) }}"
                       class="action-btn btn-view">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Aucune demande de CV
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>

        {{ $cvRequests->links() }}
    </div>
</div>

</div>
@endsection

{{-- ================= AJAX (INCHANGÉ) ================= --}}
@section('scripts')
<script>
$(function () {

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $('.approve-btn, .reject-btn').on('click', function () {

        let id = $(this).data('id');
        let type = $(this).data('type');

        let status = (type === 'project')
            ? ($(this).hasClass('approve-btn') ? 'accepted' : 'rejected')
            : ($(this).hasClass('approve-btn') ? 'approved' : 'rejected');

        $.ajax({
            url: `/admin/requests/${type}/${id}/status`,
            type: 'POST',
            data: {_method: 'PUT', status: status},
            success: function (res) {

                let badgeColor = (res.status === 'accepted' || res.status === 'approved')
                    ? 'success' : 'danger';

                $(`#${type}-${id} .status`).html(
                    `<span class="badge bg-${badgeColor}">${res.status}</span>`
                );

                $(`#${type}-${id} .approve-btn, #${type}-${id} .reject-btn`).remove();
            },
            error: function () {
                alert('Erreur lors du changement de statut');
            }
        });
    });

});



</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filter = document.getElementById('statusFilter');

    filter.addEventListener('change', function () {
        const selectedStatus = this.value.toLowerCase();

        // tous les tableaux
        const tables = document.querySelectorAll('.table-bordered');

        tables.forEach(table => {
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const badge = row.querySelector('.status span');
                if (!badge) return;

                // trim() pour enlever les espaces et retours à la ligne
                const statusText = badge.textContent.trim().toLowerCase();

                if (!selectedStatus || statusText === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});
</script>



@endsection
