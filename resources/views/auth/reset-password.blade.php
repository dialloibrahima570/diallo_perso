@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="p-4 shadow card rounded-4">
                <h3 class="mb-4 text-center fw-bold">Réinitialisation du mot de passe</h3>

                {{-- Affichage messages --}}
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    {{-- Token caché --}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Nouveau mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Nouveau mot de passe" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmez le mot de passe" required>
                    </div>

                    <button type="submit" class="btn btn-login w-100 fw-bold">Réinitialiser le mot de passe</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
