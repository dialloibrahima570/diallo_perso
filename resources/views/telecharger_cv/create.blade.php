@extends('layouts.app')

@section('title', 'Demande de téléchargement CV')

@section('content')
<section id="contact" class="py-5 contact-section">
  <div class="container">
    <div class="mb-5 text-center">
      <h2 class="mb-3 fw-bold">Demander le téléchargement du CV</h2>
      <p class="lead">Remplissez le formulaire pour recevoir l'accès au CV.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <form action="{{ route('telecharger_cv.store') }}" method="POST" class="contact-form">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Message (optionnel)</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message"></textarea>
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
