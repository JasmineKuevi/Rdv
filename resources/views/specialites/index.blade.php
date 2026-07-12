@extends('layouts.public')

@section('title', 'Specialites medicales - Medilink')

@section('content')
<header class="bg-white border-bottom py-5">
    <div class="container">
        <h1 class="section-title display-6">Parcourir les specialites</h1>
        <p class="lead text-muted mb-0">Choisissez un service pour trouver rapidement un praticien adapte.</p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        @php
            $specialites = [
                ['Cardiologie', 'Soins du coeur et du systeme circulatoire.', 'cardio.png', 'cardiologie'],
                ['Dermatologie', 'Soins de la peau, des cheveux et des ongles.', 'dermato.png', 'dermatologie'],
                ['Pediatrie', 'Suivi des enfants et nourrissons.', 'pediatrie.png', 'pediatrie'],
                ['Gynecologie', 'Sante et bien-etre des femmes.', 'gyneco.png', 'gynecologie'],
                ['Neurologie', 'Troubles du cerveau et du systeme nerveux.', 'neuro.png', 'neurologie'],
                ['Dentisterie', 'Soins et hygiene bucco-dentaire.', 'dentaire.png', 'dentisterie'],
                ['Ophtalmologie', 'Sante des yeux et correction visuelle.', 'ophta.png', 'ophtalmologie'],
                ['Pneumologie', 'Soins des poumons et de la respiration.', 'pneumo.png', 'pneumologie'],
            ];
        @endphp
        <div class="row g-4">
            @foreach($specialites as [$name, $desc, $image, $slug])
                <div class="col-sm-6 col-lg-3">
                    <a class="card soft-card h-100 text-decoration-none text-dark" href="{{ route('specialites.show', $slug) }}">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/'.$image) }}" alt="{{ $name }}" width="66" height="66" class="mb-3">
                            <h2 class="h6 fw-bold">{{ $name }}</h2>
                            <p class="small text-muted mb-0">{{ $desc }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
