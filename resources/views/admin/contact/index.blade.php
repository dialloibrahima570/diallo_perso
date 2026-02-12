@extends('admin.layout')

@section('title', 'Mon CV')

@section('content')
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1 id="mon">gestion des contacts</h1>


    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher un projet...">
        <div id="searchResults"></div>
    </div>
    <div class="d-flex gap-2 mt-3 flex-wrap">
        <select id="statusFilter" class="form-select w-auto rounded-pill">
            <option value="">Tous les messages</option>
            <option value="unread">Non lus</option>
            <option value="read">Lus</option>
        </select>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
:root{
  --bg:#f6f8fc;
  --card:#ffffff;
  --primary:#dc2626;
  --secondary:#111827;
  --text:#1f2937;
  --muted:#6b7280;
  --border:#e5e7eb;
  --radius:14px;
}

body{
  background:var(--bg);
  font-family:"Inter",Segoe UI,Arial,sans-serif;
  color:var(--text);
}

#mon{
    color: #dc2626;
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
    color: red;   /* centrer le titre */
}

.header .menu-btn {
    font-size: 24px;
    cursor: pointer;
    background: #ae1e1e;
    border: none;
    color: #fcf8f8;
}
/* CONTAINER */
.dashboard-container{
  max-width:1400px;
  margin:auto;
  padding:24px;
}

/* HEADER */
.page-header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  flex-wrap:wrap;
  margin-bottom:22px;
}

.page-title{
  font-size:22px;
  font-weight:700;
}

.page-title span{
  color:var(--primary);
}

.stats-cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:16px;
    margin-bottom:25px;
}
.stats-card{
    background:var(--card);
    border-radius:16px;
    padding:20px;
    box-shadow:0 6px 15px rgba(0,0,0,.06);
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
    transition:0.3s;
    cursor:default;
}
.stats-card:hover{
    transform:translateY(-5px);
    box-shadow:var(--hover-shadow);
}
.stats-card i{
    font-size:28px;
    color:var(--primary);
    margin-bottom:10px;
}
.stats-card h3{
    margin:0;
    font-size:14px;
    color:var(--primary);
}
.stats-card p{
    margin:10px 0 0;
    font-size:30px;
    font-weight:bold;
    color:var(--text);
}

/* TABLE */
.card-box{
  background:var(--card);
  border-radius:var(--radius);
  border:1px solid var(--border);
  padding:18px;
}

.badge-status{
  padding:6px 12px;
  border-radius:20px;
  font-size:12px;
  font-weight:600;
}

.badge-unread{
  background:#fee2e2;
  color:#b91c1c;
}

.badge-read{
  background:#dcfce7;
  color:#166534;
}

.action-btn{
  border-radius:50%;
  width:34px;
  height:34px;
  border:1px solid var(--border);
  background:#fff;
}
.btn-view{color:#2563eb;}
.btn-delete{color:#dc2626;}

/* RESPONSIVE TABLE LIKE HISTORIQUE */

/* MOBILE FIRST : transformer la table en cartes sur mobile */
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

/* Cacher table sur mobile, afficher cartes */
.table-responsive {
    display: none;
}

/* DESKTOP : afficher table et cacher cartes */
@media (min-width: 768px) {
    .contacts-mobile { display: none; }
    .table-responsive { display: block; overflow-x: auto; }
}

/* Table responsive desktop */
.table-responsive table {
    width: 100%;
    min-width: 600px;
    border-collapse: collapse;
}

.table-responsive th,
.table-responsive td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
}
</style>

<div class="dashboard-container">

{{-- STATS --}}
<div class="stats-cards">
    <div class="stats-card">
        <i class="bi bi-envelope"></i>
        <h3>Messages reçus</h3>
        <p>{{ $totalMessages }}</p>
    </div>

    <div class="stats-card">
        <i class="bi bi-envelope-open"></i>
        <h3>Messages lus</h3>
        <p>{{ $readMessages }}</p>
    </div>

    <div class="stats-card">
        <i class="bi bi-exclamation-circle"></i>
        <h3>Messages non lus</h3>
        <p>{{ $unreadMessages }}</p>
    </div>
</div>

{{-- MOBILE CARDS --}}
<div class="contacts-mobile">
@foreach($contacts as $contact)
    <div class="contact-card">
        <div class="contact-row">
            <span class="badge {{ $contact->status === 'unread' ? 'badge-unread' : 'badge-read' }}">
                {{ $contact->status === 'unread' ? 'Non lu' : 'Lu' }}
            </span>
            <small>{{ $contact->created_at->format('d/m/Y') }}</small>
        </div>
        <div class="contact-name">{{ $contact->name }}</div>
        <div class="contact-email">{{ $contact->email }}</div>
        <div class="contact-subject">{{ $contact->subject ?? '-' }}</div>
        <div class="d-flex gap-2 mt-2">
            <a href="{{ route('admin.contact.show', $contact) }}" class="btn btn-sm btn-view">
                <i class="bi bi-eye"></i> Voir
            </a>
            <form action="{{ route('admin.contact.destroy', $contact) }}"
                  method="POST" class="d-inline"
                  onsubmit="return confirm('Supprimer ce message ?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-delete">
                <i class="bi bi-trash"></i> Supprimer
              </button>
            </form>
        </div>
    </div>
@endforeach
</div>

{{-- TABLE DESKTOP --}}
<div class="card-box">
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Sujet</th>
          <th>Status</th>
          <th>Date</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
<tbody id="contactsTable">
@forelse($contacts as $contact)
<tr
    data-name="{{ strtolower($contact->name) }}"
    data-email="{{ strtolower($contact->email) }}"
    data-subject="{{ strtolower($contact->subject ?? '') }}"
    data-status="{{ $contact->status }}"
>
    <td>{{ $contact->id }}</td>
    <td>{{ $contact->name }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->subject ?? '-' }}</td>
    <td>
        @if($contact->status === 'unread')
            <span class="badge-status badge-unread">Non lu</span>
        @else
            <span class="badge-status badge-read">Lu</span>
        @endif
    </td>
    <td>{{ $contact->created_at->format('d/m/Y') }}</td>
    <td class="text-end">
        <a href="{{ route('admin.contact.show', $contact) }}" class="action-btn btn-view">
            <i class="bi bi-eye"></i>
        </a>

        <form action="{{ route('admin.contact.destroy', $contact) }}"
              method="POST" class="d-inline"
              onsubmit="return confirm('Supprimer ce message ?')">
          @csrf
          @method('DELETE')
          <button class="action-btn btn-delete">
            <i class="bi bi-trash"></i>
          </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center text-muted">
        Aucun message trouvé
    </td>
</tr>
@endforelse
</tbody>

    </table>
  </div>

  {{-- PAGINATION --}}
  <div class="mt-3">
    {{ $contacts->links() }}
  </div>
</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('tbody tr');

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;

        rows.forEach(row => {
            const name = row.dataset.name;
            const email = row.dataset.email;
            const subject = row.dataset.subject;
            const status = row.dataset.status;

            const matchSearch =
                name.includes(searchValue) ||
                email.includes(searchValue) ||
                subject.includes(searchValue);

            const matchStatus =
                statusValue === '' || status === statusValue;

            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    searchInput.addEventListener('keyup', filterTable);
    statusFilter.addEventListener('change', filterTable);

});
</script>

@endsection
