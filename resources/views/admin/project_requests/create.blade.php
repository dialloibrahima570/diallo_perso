@extends('layouts.app')

@section('title', 'Demander un projet | Portfolio Diallo')

@section('content')

<section id="project-request" class="py-5 contact-section">
  <div class="container">
    <div class="mb-5 text-center">
      <h2 class="mb-3 fw-bold">Demander le projet : {{ $project }}</h2>
      <p class="lead">Remplissez le formulaire ci-dessous pour nous envoyer votre demande.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <form action="{{ route('project.request.store') }}" method="POST" class="contact-form">
          @csrf

          <input type="hidden" name="project" value="{{ $project }}">

          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" value="{{ old('name') }}" required>
            @error('name')
              <div class="mt-1 text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" value="{{ old('email') }}" required>
            @error('email')
              <div class="mt-1 text-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Type : liste déroulante -->
          <input type="hidden" name="project" value="{{ $project }}">
             <input type="hidden" name="type" value="project">

          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message" required>{{ old('message') }}</textarea>
            @error('message')
              <div class="mt-1 text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-login btn-lg">
              <i class="bi bi-send"></i> Envoyer la demande
            </button>
          </div>

          @if(session('success'))
            <div class="mt-3 text-center alert alert-success">
              {{ session('success') }}
            </div>
          @endif

        </form>

      </div>
    </div>
  </div>
</section>

@endsection
