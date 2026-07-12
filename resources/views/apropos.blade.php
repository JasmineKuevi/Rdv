@extends('layouts.public')

@section('title', 'A propos - Medilink')

@section('content')
<header class="bg-white border-bottom py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <h1 class="section-title display-6">Moderniser l'acces aux soins</h1>
                <p class="lead text-muted mb-0">Medilink transforme la prise de rendez-vous medical en un parcours simple pour les patients et mieux organise pour les equipes de sante.</p>
            </div>
            <div class="col-lg-5">
                <img class="img-fluid rounded shadow-sm" src="{{ asset('images/medilink_why.png') }}" alt="Equipe medicale Medilink">
            </div>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="soft-card bg-white p-4 h-100">
                    <div class="feature-icon mb-3"><i class="bi bi-folder2-open"></i></div>
                    <h2 class="h5 fw-bold">Centraliser</h2>
                    <p class="text-muted mb-0">Regrouper les informations essentielles pour limiter les pertes de dossiers et les oublis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="soft-card bg-white p-4 h-100">
                    <div class="feature-icon mb-3"><i class="bi bi-calendar2-check"></i></div>
                    <h2 class="h5 fw-bold">Planifier</h2>
                    <p class="text-muted mb-0">Rendre la demande de rendez-vous plus rapide et plus lisible pour tout le monde.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="soft-card bg-white p-4 h-100">
                    <div class="feature-icon mb-3"><i class="bi bi-heart-pulse"></i></div>
                    <h2 class="h5 fw-bold">Accompagner</h2>
                    <p class="text-muted mb-0">Aider les soignants a se concentrer sur le suivi et la qualite de prise en charge.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
