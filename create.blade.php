@extends('layouts.app')

@section('title', "Demande de projet | $project")

@section('content')
<div class="container py-5">
    <h2>Demande pour le projet : {{ $project }}</h2>

    <form action="{{ route('project.request.store') }}" method="POST">
        @csrf
        <input type="hidden" name="project" value="{{ $project }}">

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-login">Envoyer la demande</button>
    </form>
</div>
@endsection
