@extends('admin.layout')

@section('title', 'Voir Message')

@section('content')

<!-- ===== HEADER ===== -->
<div class="header">
    <label for="menu-toggle" class="menu-btn">☰</label>
    <h1>Voir Les Messages</h1>
</div>

<!-- ===== Liens externes ===== -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="container py-4">

    <!-- Titre -->
    <h1 class="mb-4" style="font-size: 28px; color: #ff2e2e;">Message de {{ $contact->name }}</h1>

    <!-- Carte message -->
    <div class="card shadow mb-4">
        <div class="card-header" style="background: linear-gradient(135deg, #ff2e2e, #b30000); color: #fff;">
            <strong>Sujet:</strong> {{ $contact->subject }}
        </div>
        <div class="card-body" style="font-size: 15px;">
            <p><strong>Nom :</strong> {{ $contact->name }}</p>
            <p><strong>Email :</strong> {{ $contact->email }}</p>
            <p><strong>Date :</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
            <hr>
            <p>{{ $contact->message }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Retour</a>

            <!-- Formulaire suppression -->
            <form action="{{ route('admin.contact.destroy', $contact) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-red">Supprimer</button>
            </form>
        </div>
    </div>

    <!-- Formulaire pour répondre -->
    <div class="card shadow">
        <div class="card-header" style="background: linear-gradient(135deg, #ff2e2e, #b30000); color: #fff;">
            <strong>Répondre à {{ $contact->email }}</strong>
        </div>
        <div class="card-body custom-reply-form">

            <!-- Messages de succès / erreur -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.contact.reply', $contact) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="subject" class="form-label">Sujet</label>
                    <input type="text" name="subject" id="subject" class="form-control form-control-sm" value="Votre message reçu – {{ $contact->subject }}" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" class="form-control form-control-sm" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn-red"><i class="bi bi-send"></i> Envoyer la réponse</button>
            </form>
        </div>
    </div>
    <!-- Bouton Retour rouge dégradé -->
<a href="{{ route('admin.contact.index') }}" class="btn-red mt-3">
    <i class="bi bi-arrow-left"></i> Retour
</a>


</div>

<!-- ===== CSS Unifié ===== -->
<style>
/* Labels et inputs */
.custom-reply-form label {
    font-weight: 500;
    font-size: 14px;
    color: #ff2e2e;
}

.custom-reply-form .form-control {
    font-size: 14px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    transition: all 0.3s;
}

.custom-reply-form .form-control:focus {
    border-color: #ff2e2e;
    box-shadow: 0 4px 12px rgba(255,46,46,0.2);
    outline:none;
}

.header h1 {
    text-align: center;
    color: #ff2e2e; /* ton rouge dégradé */
    font-size: 24px;
    flex: unset; /* empêche le h1 de prendre tout l'espace */
    padding-right: 40%;
}


/* Conteneur principal centré et responsive */
.main-container {
    max-width: 900px;   /* largeur max sur grands écrans */
    margin: 0 auto;     /* centre horizontalement */
    padding: 20px;
}

/* H1 centré */
.main-container h1 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 25px;
    word-break: break-word; /* évite débordement */
}

/* Carte infos responsive */
.main-container .card {
    width: 100%;
    box-sizing: border-box;
    overflow-wrap: break-word; /* casse les mots longs */
    word-wrap: break-word;
    word-break: break-word;
}

/* Carte infos avec scroll horizontal si vraiment nécessaire */
.main-container .card-body {
    overflow-x: auto;
}

/* Formulaire et boutons responsive */
.main-container .card-body .form-control {
    width: 100%;
    box-sizing: border-box;
}

.main-container .btn-red,
.main-container .btn-secondary {
    width: 100%;
    max-width: 250px;
    display: block;
    margin: 10px auto 0;
}

/* Responsive pour petits écrans */
@media (max-width: 768px) {
    .main-container {
        padding: 15px;
    }

    .main-container h1 {
        font-size: 22px;
    }
}

/* Boutons rouge dégradé */

.btn-red {
    background: linear-gradient(135deg, #ff2e2e, #b30000);
    border:none;
    color:#fff;
    padding: 8px 22px;
    border-radius: 30px;
    font-weight:500;
    font-size: 14px;
    display: inline-flex;
    align-items:center;
    gap:6px;
    cursor:pointer;
    transition: all 0.3s ease;
}
.btn-red:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,46,46,0.6);
}

/* Carte header rouge */
.card-header {
    font-weight: 600;
    font-size: 16px;
}

/* Responsive */
@media(max-width:768px){
    .btn-red { width:100%; justify-content:center; }
    .card-body { padding:15px; }
}

/* Carte et texte responsive pour mobile */
@media (max-width: 768px) {
    /* Réduire la taille générale de la carte */
    .card {
        padding: 10px;        /* moins d’espace intérieur */
    }

    /* Card header plus petit */
    .card-header {
        font-size: 14px;
        padding: 8px 12px;
    }

    /* Card body texte réduit */
    .card-body {
        font-size: 13px;
        padding: 10px;
    }

    /* Paragraphes et divs à l’intérieur */
    .card-body p,
    .card-body div {
        font-size: 13px;
    }

    /* Footer et boutons plus petits */
    .card-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }

    .card-footer a,
    .card-footer form button {
        font-size: 13px;
        padding: 6px 12px;
        width: 100%;
        max-width: none;
    }

    /* H1 titre de la page */
    .header h1 {
        font-size: 20px;
    }
}

</style>

@endsection
