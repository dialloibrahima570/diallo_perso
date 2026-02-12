@extends('layouts.app')

@section('title', 'Accueil | Portfolio Diallo')

@section('content')

<!-- =========================
    SECTION HOME / HERO
========================= -->
<section id="home" class="home-section-lg">

  <div id="homeCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img src="{{ asset('images/bg1.jpg') }}" class="d-block w-100" alt="Slide 1">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
          <h1 class="fw-bold">Développeur Web & Mobile</h1>
          <p class="lead">Je crée des expériences digitales modernes et élégantes</p>
          <div class="d-flex gap-3 flex-wrap justify-content-center">
            <a href="#projects" class="btn btn-login btn-lg">
              <i class="bi bi-kanban"></i> Projets
            </a>
            <a href="#contact" class="btn btn-outline-light btn-lg">
              <i class="bi bi-envelope"></i> Contact
            </a>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <img src="{{ asset('images/bg2.jpg') }}" class="d-block w-100" alt="Slide 2">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
          <h1 class="fw-bold">Création de Sites Modernes</h1>
          <p class="lead">Interfaces performantes et responsive</p>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="{{ asset('images/bg3.jpg') }}" class="d-block w-100" alt="Slide 3">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
          <h1 class="fw-bold">Applications Mobiles</h1>
          <p class="lead">Applications rapides et fluides</p>
        </div>
      </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>
</section>

<!-- =========================
    SECTION ABOUT
========================= -->
<section id="about" class="about-section py-5">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-5 mb-4">
        <img src="{{ asset('images/profile.jpg') }}" class="img-fluid rounded shadow" alt="Profil">
      </div>

      <div class="col-lg-7">
        <h2 class="fw-bold mb-3">À Propos de Moi</h2>
        <p class="lead">
          Développeur web et mobile passionné par les technologies modernes.
        </p>
        <p>
          Je transforme des idées en solutions digitales performantes et élégantes.
        </p>

        <div class="my-4 text-center row">
  <div class="col-4">
    <h3 class="counter" data-target="{{ $statistique->annees_experience }}">0</h3>
    <p>Années d'expérience</p>
  </div>
  <div class="col-4">
    <h3 class="counter" data-target="{{ $statistique->projets_realises }}">0</h3>
    <p>Projets réalisés</p>
  </div>
  <div class="col-4">
    <h3 class="counter" data-target="{{ $statistique->clients_satisfaits }}">0</h3>
    <p>Clients satisfaits</p>
  </div>
</div>


        <a href="#contact" class="btn btn-login btn-lg me-3">
          <i class="bi bi-envelope"></i> Me contacter
        </a>
        <a href="{{ asset('resume.pdf') }}" class="btn btn-outline-dark btn-lg">
          <i class="bi bi-file-earmark-person"></i> Télécharger CV
        </a>
      </div>

    </div>
  </div>
</section>

<!-- =========================
    SECTION SKILLS
========================= -->
<section id="skills" class="skills-section py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Mes Compétences</h2>
      <p class="lead">Technologies que j’utilise au quotidien</p>
    </div>

    <div class="row g-4">

      <div class="col-md-4 text-center">
        <div class="skill-card p-4 shadow rounded">
          <i class="bi bi-code-slash display-3"></i>
          <h5 class="fw-bold mt-3">Développement Web</h5>
          <p>HTML, CSS, JS, Laravel, React</p>
        </div>
      </div>

      <div class="col-md-4 text-center">
        <div class="skill-card p-4 shadow rounded">
          <i class="bi bi-phone display-3"></i>
          <h5 class="fw-bold mt-3">Mobile</h5>
          <p>Flutter, React Native</p>
        </div>
      </div>

      <div class="col-md-4 text-center">
        <div class="skill-card p-4 shadow rounded">
          <i class="bi bi-server display-3"></i>
          <h5 class="fw-bold mt-3">Back-End</h5>
          <p>MySQL, API REST, Auth</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================
    SECTION PROJECTS
========================= -->
<section id="projects" class="projects-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Mes Projets</h2>
      <p class="lead">Quelques réalisations récentes</p>
    </div>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="card project-card shadow">
          <img src="{{ asset('images/project1.jpg') }}" class="card-img-top">
          <div class="card-body text-center">
            <h5 class="fw-bold">E-commerce</h5>
            <p>Laravel + Stripe</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card project-card shadow">
          <img src="{{ asset('images/project2.jpg') }}" class="card-img-top">
          <div class="card-body text-center">
            <h5 class="fw-bold">App Mobile</h5>
            <p>Flutter</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card project-card shadow">
          <img src="{{ asset('images/project3.jpg') }}" class="card-img-top">
          <div class="card-body text-center">
            <h5 class="fw-bold">Dashboard Admin</h5>
            <p>Laravel Admin</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================
    SECTION CONTACT SECURISE
========================= -->
<section id="contact" class="contact-section py-5 bg-light">
  <div class="container">
    <h2>Test Contact</h2>
    <form action="{{ route('contact.store') }}" method="POST">
      @csrf
      <input type="text" name="name" placeholder="Nom" class="form-control mb-2">
      <input type="email" name="email" placeholder="Email" class="form-control mb-2">
      <textarea name="message" placeholder="Message" class="form-control mb-2"></textarea>
      <button class="btn btn-primary">Envoyer</button>
    </form>

    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

  </div>
</section>


@endsection
