@extends('admin.layout')

@section('title', 'Détail demande CV')

@section('content')

<!-- ====== Liens externes ====== -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ====== CSS Spécifique ====== -->
<style>
/* ===== VARIABLES ===== */
:root {
  --bg: #f4f6f9;
  --sidebar: #ffffff;
  --card: #ffffff;
  --red: #e63946;
  --text: #1f2933;
  --muted: #6b7280;
  --border: #e5e7eb;
  --graph-bg: #ffe5e5;
  --hover-shadow: 0 12px 20px rgba(0,0,0,0.12);
}

/* ===== GLOBAL ===== */
* { box-sizing: border-box; }
body { margin:0; font-family:'Segoe UI', Arial, sans-serif; background: var(--bg); color: var(--text); }
a { text-decoration:none; color: inherit; }
h1,h2,h3,h4,h5,h6 { margin:0; }
input, textarea { outline:none; }

/* ===== SIDEBAR ===== */
.sidebar {
  position: fixed; top:0; left:0; width:220px; height:100vh;
  background: var(--sidebar); padding:20px; border-right:1px solid var(--border);
  overflow-y:auto; z-index:1000;
}
.sidebar a {
  display:flex; align-items:center; padding:12px; border-radius:10px;
  margin-bottom:10px; font-weight:500; color: var(--text); transition:0.3s;
}
.sidebar a:hover { background: rgba(230,57,70,0.12); }
.sidebar-profile { display:flex; flex-direction:column; align-items:center; text-align:center;
  margin-bottom:20px; padding-bottom:15px; border-bottom:1px solid var(--border); }
.sidebar-profile img { width:50px; height:50px; border-radius:50%; border:2px solid var(--red); margin-bottom:8px; }
.sidebar-profile h4 { font-size:13px; font-weight:600; color: var(--text); }

/* ===== MAIN ===== */
.main { margin-left:220px; padding:20px; transition: margin-left 0.3s; }

/* ===== HEADER ===== */
.header {
  display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;
  position: sticky; top:0; z-index:1100; background: var(--bg); padding:10px 0;
}
.menu-btn {
  font-size:22px; cursor:pointer; background: var(--red); color:#fff; padding:10px 14px; border-radius:10px;
}
.header h1 { flex:1; text-align:center; color: var(--red); font-size:24px; }

/* ===== CARDS ===== */
.card { background: var(--card); border-radius:16px; padding:20px; box-shadow:0 6px 15px rgba(0,0,0,.06); margin-bottom:20px; }
.card-header { font-weight:600; font-size:16px; padding:12px 20px; border-bottom:1px solid #e5e7eb; color: #ff2e2e; }
.card-body { padding:20px; background:#fff; }

/* ===== BADGES ===== */
.badge { padding:6px 12px; border-radius:20px; font-size:12px; font-weight:600; text-transform: capitalize; }
.approved { background:#22c55e; color:#fff; }
.rejected { background:#e63946; color:#fff; }
.pending { background:#daaf21; color:#fff; }

/* ===== FORMULAIRES ===== */
.card-body .form-control {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 10px 14px;
    margin-bottom: 15px;
    transition: all 0.3s;
}
.card-body .form-control:focus {
    border-color: #ff2e2e;
    box-shadow: 0 4px 12px rgba(255,46,46,0.2);
    outline:none;
}

/* Labels rouges */
.card-body .form-label { font-weight:500; color:#ff2e2e; margin-bottom:6px; }

/* Bouton rouge dégradé */
.btn-red {
    background: linear-gradient(135deg, #ff2e2e, #b30000);
    border:none;
    color:#fff;
    padding:10px 24px;
    border-radius:30px;
    font-weight:500;
    font-size:14px;
    transition: all 0.3s ease;
    display:inline-flex;
    align-items:center;
    gap:6px;
    cursor:pointer;
}
.btn-red:hover { transform: translateY(-2px); box-shadow:0 8px 25px rgba(255,46,46,0.6); }

/* Espacement */
.mb-3 { margin-bottom:16px; }

/* Responsive */
@media(max-width:768px){
    .sidebar { left:-220px; transition:left 0.3s; }
    #menu-toggle:checked ~ .sidebar { left:0; }
    .main { margin-left:0; padding:15px; transition:margin-left 0.3s; }
    #menu-toggle:checked ~ .main { margin-left:220px; }
    .header h1 { text-align:center; font-size:20px; }
    .btn-red { width:100%; justify-content:center; }
    .card-body { padding:15px; }
}
</style>

<!-- ===== HEADER ===== -->
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>Répondre à la demande CV</h1>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="main-container">

    <!-- Infos CV -->
    <div class="mb-4 card">
        <div class="card-header">Informations de la demande CV</div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $cv->name }}</p>
            <p><strong>Email :</strong> {{ $cv->email }}</p>
            <p><strong>Message :</strong></p>
            <div class="p-3 border rounded bg-light">{{ $cv->message }}</div>

            <p class="mt-3">
                <strong>Statut :</strong>
                <span class="badge {{ $cv->status === 'approved' ? 'approved' : ($cv->status === 'rejected' ? 'rejected' : 'pending') }}">
                    {{ ucfirst($cv->status) }}
                </span>
            </p>
        </div>
    </div>

    <!-- Formulaire envoi -->
    <div class="card">
        <div class="card-header">Envoyer le CV</div>
        <div class="card-body">
            <form action="{{ route('admin.requests.cv.send', $cv->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Message (optionnel)</label>
                    <textarea name="message" class="form-control" rows="4" placeholder="Message qui accompagnera le CV..."></textarea>
                </div>


                <button type="submit" class="btn-red"><i class="bi bi-send"></i> Envoyer le CV</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.requests.index') }}" class="mt-3 btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

@endsection

@section('scripts')
<!-- JS spécifique si nécessaire -->
@endsection
