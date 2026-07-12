@extends('layouts.public')

@section('title', 'Prendre rendez-vous - Medilink')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card soft-card border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h3 fw-bold mb-2">Prendre un rendez-vous</h1>
                        <p class="text-muted mb-4">Choisissez un praticien, un horaire et indiquez rapidement le motif de consultation.</p>

                        @auth
                            <form method="POST" action="{{ route('rendezvous.store') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="doctor_id">Medecin</label>
                                        <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id" required>
                                            <option value="">Choisir un medecin</option>
                                            @forelse($doctors ?? [] as $doctor)
                                                <option value="{{ $doctor['id'] }}" @selected((string) old('doctor_id', $prefillDoctor ?? '') === (string) $doctor['id'])>
                                                    {{ $doctor['label'] }}
                                                </option>
                                            @empty
                                                <option value="" disabled>Aucun medecin disponible</option>
                                            @endforelse
                                        </select>
                                        @error('doctor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="scheduled_at">Date et heure</label>
                                        <input class="form-control @error('scheduled_at') is-invalid @enderror" id="scheduled_at" type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" required>
                                        @error('scheduled_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="reason">Motif</label>
                                        <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="4" placeholder="Ex: controle, douleur, suivi...">{{ old('reason') }}</textarea>
                                        @error('reason')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-lg mt-4">Envoyer la demande</button>
                            </form>
                        @else
                            <div class="alert alert-info mb-4">
                                Connectez-vous ou creez un compte patient pour finaliser une demande de rendez-vous.
                            </div>
                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <a class="btn btn-primary" href="{{ route('login', ['role' => 'patient']) }}">Se connecter</a>
                                <a class="btn btn-outline-primary" href="{{ route('register.patient') }}">Creer un compte</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
