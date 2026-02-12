@extends('layouts.app')

@section('title', 'Résultats de recherche')

@section('content')
<div class="container py-5">

    <h2 class="mb-4 fw-bold text-center">Résultats pour : "{{ $mot }}"</h2>

    {{-- Si aucun résultat --}}
    @if($resultats->isEmpty())
        <p class="text-center text-muted">Aucun résultat trouvé.</p>
    @else

        {{-- Projets --}}
        @php
            $projets = $resultats->filter(fn($item) => $item['type'] === 'projet');
            $sections = $resultats->filter(fn($item) => $item['type'] === 'section');
        @endphp

        @if($projets->isNotEmpty())
            <h3 class="mt-4 mb-3">Projets</h3>
            <div class="row g-4 mb-5">
                @foreach($projets as $projet)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            {{-- Tu peux mettre une image par défaut ou spécifique si tu as --}}
                            <img src="{{ asset('images/project_placeholder.jpg') }}" 
                                 class="card-img-top" alt="{{ $projet['titre'] }}" 
                                 style="height:220px; object-fit:cover;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="fw-bold">{{ $projet['titre'] }}</h5>
                                <p class="text-muted">{{ $projet['description'] }}</p>
                                <a href="{{ $projet['lien'] }}" class="btn btn-login btn-sm mt-2">
                                    <i class="bi bi-eye"></i> Voir le projet
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Sections --}}
        @if($sections->isNotEmpty())
            <h3 class="mt-4 mb-3">Sections de la page principale</h3>
            <div class="row g-3">
                @foreach($sections as $section)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm p-3">
                            <h5 class="fw-bold">{{ $section['titre'] }}</h5>
                            <p class="text-muted">{{ $section['description'] }}</p>
                            <a href="{{ $section['lien'] }}" class="btn btn-outline-dark btn-sm mt-2">
                                Aller à la section
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    @endif

</div>
@endsection
