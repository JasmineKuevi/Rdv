@extends('layouts.public')

@section('title', 'Medecins partenaires - Medilink')

@section('content')
<header class="bg-white border-bottom py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <h1 class="section-title display-6 mb-2">Trouvez un medecin disponible</h1>
                <p class="lead text-muted mb-0">Recherchez par nom, specialite ou ville, puis demandez un rendez-vous en ligne.</p>
            </div>
            <div class="col-lg-5">
                <form class="soft-card bg-white p-3" method="GET" action="{{ route('medecins.index') }}">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input class="form-control" name="q" value="{{ request('q') }}" placeholder="Specialite">
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" name="ville" value="{{ request('ville') }}" placeholder="Ville">
                        </div>
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        @php
            $fallbackDoctors = collect([
                (object) ['id' => 1, 'nom' => 'Kossi Mensah', 'specialite' => 'Cardiologie', 'centre_sante' => 'Clinique Esperance', 'ville' => 'Lome'],
                (object) ['id' => 2, 'nom' => 'Afi Amouzou', 'specialite' => 'Pediatrie', 'centre_sante' => 'Centre Saint-Luc', 'ville' => 'Lome'],
                (object) ['id' => 3, 'nom' => 'Yao Adjovi', 'specialite' => 'Dermatologie', 'centre_sante' => 'Cabinet Horizon', 'ville' => 'Kara'],
                (object) ['id' => 4, 'nom' => 'Mawuli Nayo', 'specialite' => 'Ophtalmologie', 'centre_sante' => 'Polyclinique Centrale', 'ville' => 'Lome'],
            ]);
            $items = isset($medecins) && count($medecins) ? collect($medecins) : $fallbackDoctors;
            $term = strtolower(request('q', ''));
            $city = strtolower(request('ville', ''));
            if ($term || $city) {
                $items = $items->filter(function ($doctor) use ($term, $city) {
                    $haystack = strtolower(($doctor->nom ?? '').' '.($doctor->specialite ?? ''));
                    $doctorCity = strtolower($doctor->ville ?? '');
                    return (!$term || str_contains($haystack, $term)) && (!$city || str_contains($doctorCity, $city));
                });
            }
        @endphp

        <div class="row g-4">
            @forelse($items as $medecin)
                <div class="col-md-6 col-lg-3">
                    <article class="card soft-card h-100">
                        <div class="card-body text-center">
                            <img class="rounded-circle mb-3" width="92" height="92" alt="Dr {{ $medecin->nom }}" src="https://ui-avatars.com/api/?name={{ urlencode('Dr '.$medecin->nom) }}&background=075aa8&color=fff&size=120">
                            <h2 class="h5 fw-bold mb-1">Dr {{ $medecin->nom }}</h2>
                            <p class="text-primary fw-semibold mb-2">{{ $medecin->specialite }}</p>
                            <p class="small text-muted mb-1"><i class="bi bi-hospital me-1"></i>{{ $medecin->centre_sante }}</p>
                            <p class="small text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $medecin->ville }}</p>
                            <a class="btn btn-outline-primary w-100" href="{{ route('rendezvous.create', ['doctor' => $medecin->id]) }}">
                                Prendre RDV
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="soft-card bg-white p-5 text-center">
                        <i class="bi bi-search display-5 text-muted"></i>
                        <h2 class="h5 mt-3">Aucun medecin trouve</h2>
                        <p class="text-muted">Essayez une autre specialite ou une autre ville.</p>
                        <a class="btn btn-primary" href="{{ route('medecins.index') }}">Reinitialiser</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
