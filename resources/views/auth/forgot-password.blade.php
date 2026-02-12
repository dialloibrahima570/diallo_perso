@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="p-4 shadow card rounded-4">
                <h3 class="mb-4 text-center fw-bold">Réinitialisation du mot de passe</h3>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" required>
                    </div>

                    <button type="submit" class="btn btn-login w-100">Envoyer le lien</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
