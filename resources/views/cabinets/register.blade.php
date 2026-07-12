@extends('layouts.public')

@section('title', 'Inscrire un cabinet - Medilink')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card soft-card border-0">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="h3 fw-bold text-center mb-2">Inscrire votre etablissement</h1>
                        <p class="text-muted text-center mb-4">Rejoignez le reseau Medilink pour moderniser la gestion de vos patients et rendez-vous.</p>

                        <form action="{{ route('cabinets.register.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="nom_hopital" class="form-label">Nom de l'hopital ou du cabinet</label>
                                    <input type="text" class="form-control" id="nom_hopital" name="nom_hopital" value="{{ old('nom_hopital') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="adresse" class="form-label">Adresse complete</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Envoyer la demande</button>
                        </form>

                        <p class="text-center text-muted small mt-4 mb-0">
                            Deja inscrit ?
                            <a href="{{ route('cabinets.login.show') }}" class="text-decoration-none">Connectez-vous ici</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
