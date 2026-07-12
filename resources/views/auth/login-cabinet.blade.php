@extends('layouts.public')

@section('title', 'Connexion cabinet - Medilink')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card soft-card border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h3 fw-bold text-center mb-2">Connexion cabinet</h1>
                        <p class="text-muted text-center mb-4">Accedez a l'espace de gestion Medilink.</p>

                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="role" value="admin">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">Se connecter</button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('cabinets.register.show') }}" class="small text-decoration-none">Inscrire un cabinet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
