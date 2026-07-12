@extends('layouts.public')

@section('title', 'Connexion - Medilink')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card soft-card border-0">
                    <div class="card-body p-4 p-md-5">
                        @php $role = $role ?? request('role', 'patient'); @endphp
                        <h1 class="h3 fw-bold text-center mb-2">Connexion</h1>
                        <p class="text-muted text-center mb-4">Accedez a votre espace Medilink.</p>

                        <ul class="nav nav-pills nav-justified mb-4">
                            @foreach(['patient' => 'Patient', 'medecin' => 'Medecin', 'admin' => 'Admin'] as $value => $label)
                                <li class="nav-item">
                                    <a class="nav-link {{ $role === $value ? 'active' : '' }}" href="{{ route('login', ['role' => $value]) }}">{{ $label }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <input type="hidden" name="role" value="{{ $role }}">

                            <div class="mb-3">
                                <label class="form-label" for="email">Adresse e-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Mot de passe</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button class="btn btn-primary w-100 btn-lg">Se connecter</button>
                        </form>

                        <div class="text-center small mt-4">
                            Pas encore de compte ?
                            <a href="{{ route('register.patient') }}" class="text-decoration-none">Creer un compte patient</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
