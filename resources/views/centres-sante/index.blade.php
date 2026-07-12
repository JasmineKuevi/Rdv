@extends('layouts.public')

@section('title', 'Centres de sante - Medilink')

@section('content')
<header class="bg-white border-bottom py-5">
    <div class="container">
        <h1 class="section-title display-6">Centres de sante partenaires</h1>
        <p class="lead text-muted mb-0">Des etablissements organises pour mieux accueillir les patients.</p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        @php
            $centres = [
                ['Clinique Esperance', 'Lome', 'Medecine generale, Cardiologie, Pediatrie'],
                ['Centre Saint-Luc', 'Lome', 'Pediatrie, Gynecologie, Analyses'],
                ['Polyclinique Centrale', 'Kara', 'Ophtalmologie, Dermatologie, Urgences'],
            ];
        @endphp
        <div class="row g-4">
            @foreach($centres as [$name, $city, $services])
                <div class="col-md-6 col-lg-4">
                    <article class="card soft-card h-100">
                        <div class="card-body">
                            <div class="feature-icon mb-3"><i class="bi bi-hospital"></i></div>
                            <h2 class="h5 fw-bold">{{ $name }}</h2>
                            <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $city }}</p>
                            <p class="small mb-4">{{ $services }}</p>
                            <a class="btn btn-outline-primary" href="{{ route('medecins.index', ['ville' => $city]) }}">Voir les medecins</a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
