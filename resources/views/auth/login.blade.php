@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="p-4 shadow card rounded-4">
                <h3 class="mb-4 text-center fw-bold">Connexion</h3>

                {{-- Messages --}}
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="votre email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe" required autocomplete="new-password">
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Mot de passe oublié ?</a>
                    </div>

                    <button type="submit" class="btn btn-login w-100 fw-bold">Se connecter</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
