@extends('admin.layout')



@section('title', 'Ajouter un projet')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@section('content')
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>Ajouter un projet</h1>
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Rechercher un projet...">
        <div id="searchResults"></div>
    </div>
</div>

<style>
/* Formulaire style dashboard */
.form-card{
    max-width:700px;
    margin:auto;
    background: var(--card);
    border-radius:18px;
    padding:30px;
    box-shadow:0 6px 15px rgba(0,0,0,.06);
    transition:0.3s;
}
.form-card:hover{
    box-shadow:0 14px 24px rgba(0,0,0,.12);
}

.form-card h3{
    color: var(--red);
    margin-bottom:20px;
    text-align:center;
}

.form-card .form-label{
    font-weight:600;
    color:var(--text);
}

.form-card input[type="text"],
.form-card input[type="date"],
.form-card input[type="file"],
.form-card select,
.form-card textarea{
    width:100%;
    padding:10px 15px;
    border-radius:20px;
    border:1px solid var(--border);
    margin-bottom:15px;
    outline:none;
    font-size:14px;
}

.form-card textarea{
    resize:none;
}

.form-card button{
    background: var(--red);
    color:#fff;
    border:none;
    padding:10px 20px;
    border-radius:25px;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}

.form-card button:hover{
    background:#d32f2f;
}

.form-card .btn-outline-secondary{
    border:1px solid var(--red);
    color: var(--red);
    background:#fff;
}

.form-card .btn-outline-secondary:hover{
    background:var(--red);
    color:#fff;
}

@media(max-width:768px){
    .form-card{
        padding:20px;
    }
    .header h1{
        font-size:18px;
    }
}
</style>

<div class="cards">
    <div class="form-card">
        <h3>Nouveau projet</h3>
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Nom -->
            <label class="form-label">Nom du projet</label>
            <input type="text" name="name" placeholder="Nom du projet" required>

            <!-- Technologies -->
            <label class="form-label">Technologies</label>
            <input type="text" name="technos" placeholder="Ex: Laravel, Vue.js" required>

            <!-- Description -->
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" placeholder="Description du projet"></textarea>

            <!-- Date -->
            <label class="form-label">Date</label>
            <input type="date" name="date" required>

            <!-- Statut -->
            <label class="form-label">Statut</label>
            <select name="status" required>
                <option value="en cours">En cours</option>
                <option value="terminé">Terminé</option>
            </select>

            <!-- Image -->
            <label class="form-label">Image du projet</label>
            <input type="file" name="image">

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('admin.projects') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button type="submit">
                    <i class="bi bi-plus"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
