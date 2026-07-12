@extends('layouts.public')

@section('title', 'Medilink - Rendez-vous medicaux en ligne')

@push('styles')
<style>
    .hero {
        min-height: calc(100vh - 70px);
        display: flex;
        align-items: center;
        background:
            linear-gradient(90deg, rgba(8, 52, 95, .92), rgba(7, 90, 168, .74)),
            url("{{ asset('images/medical-bg.jpg') }}") center/cover no-repeat;
        color: #fff;
    }

    .hero h1 {
        font-size: clamp(2.2rem, 5vw, 4.8rem);
        line-height: 1.02;
        font-weight: 850;
        letter-spacing: 0;
    }

    .search-panel {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 24px 60px rgba(0, 0, 0, .22);
    }

    .metric-band {
        background: #08345f;
        color: #fff;
    }

    .feature-icon {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        background: #eaf5ff;
        color: #075aa8;
        font-size: 1.35rem;
    }

    .specialty-card img {
        width: 58px;
        height: 58px;
        object-fit: contain;
    }

    .cta-band {
        background: linear-gradient(135deg, #075aa8, #08345f);
        color: #fff;
    }
</style>
@endpush

@section('content')
<section class="hero">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge text-bg-warning mb-3">Plateforme de sante</span>
                <h1>Reservez vos soins sans perdre votre journee.</h1>
                <p class="lead mt-3 mb-4">
                    Medilink aide les patients a trouver un medecin, prendre rendez-vous et retrouver leurs informations de sante dans un espace simple.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a class="btn btn-warning btn-lg fw-semibold" href="{{ route('rendezvous.create') }}">
                        <i class="bi bi-calendar-plus me-2"></i>Prendre rendez-vous
                    </a>
                    <a class="btn btn-outline-light btn-lg" href="{{ route('medecins.index') }}">
                        <i class="bi bi-search me-2"></i>Trouver un medecin
                    </a>
                </div>
            </div>
            <div class="col-lg-5">
                <form class="search-panel p-3 p-md-4" method="GET" action="{{ route('medecins.index') }}">
                    <h2 class="h5 text-dark fw-bold mb-3">Recherche rapide</h2>
                    <div class="mb-3">
                        <label class="form-label text-muted" for="q">Specialite ou medecin</label>
                        <input class="form-control form-control-lg" id="q" name="q" placeholder="Cardiologie, Dr Mensah...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted" for="ville">Ville</label>
                        <input class="form-control form-control-lg" id="ville" name="ville" placeholder="Lome, Kara...">
                    </div>
                    <button class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-search me-2"></i>Rechercher
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="metric-band py-4">
    <div class="container">
        <div class="row g-3 text-center">
            <div class="col-6 col-lg-3"><div class="h2 fw-bold mb-0">200+</div><div>Medecins</div></div>
            <div class="col-6 col-lg-3"><div class="h2 fw-bold mb-0">5k+</div><div>Patients</div></div>
            <div class="col-6 col-lg-3"><div class="h2 fw-bold mb-0">24h</div><div>Demandes en ligne</div></div>
            <div class="col-6 col-lg-3"><div class="h2 fw-bold mb-0">3</div><div>Espaces securises</div></div>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <img class="img-fluid rounded shadow-sm" src="{{ asset('images/medilink_why.png') }}" alt="Patient utilisant Medilink">
            </div>
            <div class="col-lg-7">
                <h2 class="section-title mb-3">Un parcours de soins plus fluide</h2>
                <p class="text-muted fs-5">La plateforme rassemble les fonctions essentielles pour organiser les consultations sans multiplier les appels et les papiers.</p>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="feature-icon"><i class="bi bi-calendar-check"></i></div>
                            <div><h3 class="h6 fw-bold">Rendez-vous rapides</h3><p class="text-muted mb-0">Choix du medecin, motif et creneau depuis un formulaire clair.</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="feature-icon"><i class="bi bi-file-medical"></i></div>
                            <div><h3 class="h6 fw-bold">Dossier patient</h3><p class="text-muted mb-0">Un espace personnel pour centraliser les informations utiles.</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                            <div><h3 class="h6 fw-bold">Acces par roles</h3><p class="text-muted mb-0">Patients, medecins et administration ont chacun leur espace.</p></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="feature-icon"><i class="bi bi-hospital"></i></div>
                            <div><h3 class="h6 fw-bold">Centres partenaires</h3><p class="text-muted mb-0">Les cabinets peuvent rejoindre l'ecosysteme Medilink.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end gap-3 mb-4">
            <div>
                <h2 class="section-title mb-1">Specialites disponibles</h2>
                <p class="text-muted mb-0">Quelques services frequemment recherches par les patients.</p>
            </div>
            <a class="btn btn-outline-primary d-none d-md-inline-flex" href="{{ route('specialites.index') }}">Tout voir</a>
        </div>
        <div class="row g-3">
            @php
                $specialites = [
                    ['Cardiologie', 'cardio.png', 'cardiologie'],
                    ['Pediatrie', 'pediatrie.png', 'pediatrie'],
                    ['Dermatologie', 'dermato.png', 'dermatologie'],
                    ['Ophtalmologie', 'ophta.png', 'ophtalmologie'],
                ];
            @endphp
            @foreach($specialites as [$name, $image, $slug])
                <div class="col-6 col-lg-3">
                    <a class="card soft-card specialty-card h-100 text-center text-decoration-none text-dark" href="{{ route('specialites.show', $slug) }}">
                        <div class="card-body">
                            <img src="{{ asset('images/'.$image) }}" alt="{{ $name }}" class="mb-3">
                            <h3 class="h6 fw-bold mb-0">{{ $name }}</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-band py-5">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-2">Pret a simplifier votre prochain rendez-vous ?</h2>
                <p class="lead mb-0">Creez un compte patient ou connectez-vous pour acceder a votre espace.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="btn btn-warning btn-lg fw-semibold" href="{{ route('register.patient') }}">Commencer</a>
            </div>
        </div>
    </div>
</section>
@endsection
