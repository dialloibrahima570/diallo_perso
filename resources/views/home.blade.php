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
        <img src="{{  asset('images/hom3.jpg') }}"
             class="d-block w-100"
             alt="Développeur Web et Mobile"
             fetchpriority="high"
             decoding="async"
             width="1920"
             height="900">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
          <h1 class="fw-bold">Développeur Web & Mobile</h1>
          <p class="lead">Je crée des expériences digitales modernes et élégantes</p>
          <div class="flex-wrap gap-3 d-flex justify-content-center">
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
        <img src="{{ asset('images/hero.jpg') }}"
             class="d-block w-100"
             alt="Création de sites modernes"
             loading="lazy"
             decoding="async"
             width="1920"
             height="900">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
          <h1 class="fw-bold">Création de Sites Modernes</h1>
          <p class="lead">Interfaces performantes et responsive</p>
           <div class="flex-wrap gap-3 d-flex justify-content-center">
            <a href="#projects" class="btn btn-login btn-lg">
              <i class="bi bi-kanban"></i> Projets
            </a>
            <a href="#contact" class="btn btn-outline-light btn-lg">
              <i class="bi bi-envelope"></i> Contact
            </a>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img src="{{ asset('images/DIA.png') }}"
             class="d-block w-100"
             alt="Applications mobiles"
             loading="lazy"
             decoding="async"
             width="1920"
             height="900">
        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
          <h1 class="fw-bold">Applications Mobiles</h1>
          <p class="lead">Applications rapides et fluides</p>
           <div class="flex-wrap gap-3 d-flex justify-content-center">
            <a href="#projects" class="btn btn-login btn-lg">
              <i class="bi bi-kanban"></i> Projets
            </a>
            <a href="#contact" class="btn btn-outline-light btn-lg">
              <i class="bi bi-envelope"></i> Contact
            </a>
          </div>
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
<section id="about" class="py-5 about-section">
  <div class="container">
    <div class="row align-items-center">

      <div class="mb-4 col-lg-5">
        <img src="{{ asset('images/DIALLO.png') }}"
             class="rounded shadow img-fluid"
             alt="Profil Diallo"
             loading="lazy"
             decoding="async"
             width="500"
             height="500">
      </div>

      <div class="col-lg-7">
        <h2 class="mb-3 fw-bold">À Propos de Moi</h2>
        <p class="lead">Développeur web et mobile passionné par les technologies modernes.</p>
        <p>Je transforme des idées en solutions digitales performantes et élégantes.</p>

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

        {{-- Script compteur animé --}}
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
              counter.innerText = '0';
              const updateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const current = +counter.innerText;
                const increment = target / 100;
                if(current < target){
                  counter.innerText = Math.ceil(current + increment);
                  setTimeout(updateCounter, 20);
                } else {
                  counter.innerText = target;
                }
              };
              updateCounter();
            });
          });
        </script>

        <a href="#contact" class="btn btn-login btn-lg me-3">
          <i class="bi bi-envelope"></i> Me contacter
        </a>
        <a href="{{ route('telecharger_cv.create') }}" class="btn btn-login btn-lg me-3">
          <i class="bi bi-file-earmark-person"></i> Télécharger CV
        </a>
      </div>

    </div>
  </div>
</section>

<!-- =========================
    SECTION SKILLS
========================= -->
<section id="skills" class="py-5 skills-section bg-light">
  <div class="container">
    <div class="mb-5 text-center">
      <h2 class="fw-bold">Mes Compétences</h2>
      <p class="lead">Technologies que j’utilise au quotidien</p>
    </div>

    <div class="row g-4">
      @foreach([
        ['icon'=>'bi-code-slash','title'=>'Développement Web','desc'=>'HTML, CSS, JS, Laravel, React'],
        ['icon'=>'bi-phone','title'=>'Mobile','desc'=>'Flutter, React Native'],
        ['icon'=>'bi-server','title'=>'Back-End','desc'=>'MySQL, API REST, Auth']
      ] as $skill)
      <div class="text-center col-md-4">
        <div class="p-4 rounded shadow skill-card">
          <i class="bi {{ $skill['icon'] }} display-3"></i>
          <h5 class="mt-3 fw-bold">{{ $skill['title'] }}</h5>
          <p>{{ $skill['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- =========================
     SECTION PROJECTS
========================= -->
<section id="projects" class="py-5 projects-section">
  <div class="container">
    <div class="mb-5 text-center">
      <h2 class="fw-bold">Mes Projets</h2>
      <p class="lead">Quelques réalisations récentes</p>
    </div>

    <div class="row g-4">
      @foreach( $projects as $project)
      <div class="col-md-4">
        <div class="shadow card project-card">
          <img src="{{ asset('storage/images/'.$project['img']) }}"
               class="card-img-top"
               loading="lazy"
               decoding="async"
               width="400"
               height="250"
               alt="{{ $project['title'] }}">
          <div class="text-center card-body">
            <h5 class="fw-bold">{{ $project['title'] }}</h5>
            <p class="small text-muted">{{ $project['details'] ?? 'Site complet avec paiement en ligne et gestion des commandes' }}</p>
            <p>{{ $project['desc'] }}</p>
            <a href="{{ route('project.request.create', $project['route']) }}" class="btn btn-login btn-sm">
              <i class="bi bi-eye"></i> Voir le projet
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- =========================
    SECTION CONTACT
========================= -->
<section id="contact" class="py-5 contact-section">
  <div class="container">
    <div class="mb-5 text-center">
      <h2 class="mb-3 fw-bold">Contactez-moi</h2>
      <p class="lead">Vous pouvez me contacter pour vos projets ou collaborations professionnelles.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
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
            <label for="subject" class="form-label">Sujet</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet du message" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-login btn-lg">
              <i class="bi bi-send"></i> Envoyer
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
