@extends('layouts.public')

@section('title', 'Inscription patient - Medilink')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card soft-card border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h3 fw-bold text-center mb-2">Creer un compte patient</h1>
                        <p class="text-muted text-center mb-4">Votre espace vous permettra de demander et suivre vos rendez-vous.</p>

                        <form method="POST" action="{{ route('register.patient.submit') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="last_name">Nom</label>
                                    <input class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="first_name">Prenom</label>
                                    <input class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="email">Adresse e-mail</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="password">Mot de passe</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required>
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="password_confirmation">Confirmation</label>
                                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-lg w-100 mt-4">S'inscrire</button>
                        </form>

                        <p class="text-center small mt-4 mb-0">
                            Vous avez deja un compte ?
                            <a href="{{ route('login') }}" class="text-decoration-none">Se connecter</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
