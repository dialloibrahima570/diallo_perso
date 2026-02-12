@extends('admin.layout')

@section('title', 'Mon Profil')

@section('content')
<div class="main-profile">

    <h1 style="color: var(--red); margin-bottom:20px;">Mon Profil</h1>

    <!-- Carte pour les informations personnelles -->
    <div class="profile-card">
        <form method="POST" action="{{ route('profile.update') }}"  enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
    <label>Photo de profil</label>
    @if($user->photo)
        <img src="{{ asset('storage/' . $user->photo) }}" width="100" class="mb-2">
    @endif
    <input type="file" name="photo" class="form-control">
</div>

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <button type="submit" class="btn btn-approve">Mettre à jour</button>
        </form>
    </div>

    <!-- Carte pour supprimer le compte -->
    <div class="profile-card delete-card">
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="form-group">
                <label>Confirmer le mot de passe pour supprimer le compte</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-reject">Supprimer le compte</button>
        </form>
    </div>

</div>

<style>
.main-profile {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.profile-card {
    background: var(--card);
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 6px 15px rgba(0,0,0,.06);
    transition: .3s;
}

.profile-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--hover-shadow);
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group label {
    font-weight: 500;
    margin-bottom: 5px;
    color: var(--text);
}

.form-group input {
    padding: 10px 15px;
    border-radius: 10px;
    border: 1px solid var(--border);
    outline: none;
    font-size: 14px;
    transition: 0.3s;
}

.form-group input:focus {
    border-color: var(--red);
}

.btn {
    padding: 10px 20px;
    border-radius: 20px;
    border: none;
    cursor: pointer;
    font-weight: 500;
    transition: 0.3s;
}

.btn-approve {
    background: #22c55e;
    color: #fff;
}

.btn-approve:hover {
    background: #16a34a;
}

.btn-reject {
    background: #e63946;
    color: #fff;
}

.btn-reject:hover {
    background: #c5303f;
}

.delete-card {
    border-top: 3px solid #e63946;
}
</style>
@endsection
