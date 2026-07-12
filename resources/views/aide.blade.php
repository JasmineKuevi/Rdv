@extends('layouts.public')

@section('title', 'Aide - Medilink')

@section('content')
<header class="bg-white border-bottom py-5">
    <div class="container">
        <h1 class="section-title display-6">Centre d'aide</h1>
        <p class="lead text-muted mb-0">Les reponses rapides pour utiliser Medilink sans blocage.</p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="accordion soft-card overflow-hidden" id="faqAccordion">
                    @php
                        $faqs = [
                            ['Comment prendre un rendez-vous ?', 'Cliquez sur Prendre rendez-vous, choisissez un medecin, indiquez un creneau et validez la demande depuis votre compte patient.'],
                            ['Puis-je rechercher par ville ?', 'Oui. La page Medecins permet de filtrer les praticiens par specialite ou par ville.'],
                            ['A quoi sert le dossier patient ?', 'Il regroupe les informations utiles au suivi medical et donne un acces rapide aux prochaines consultations.'],
                            ['Un cabinet peut-il rejoindre Medilink ?', 'Oui. Les centres peuvent utiliser la page dediee pour lancer leur inscription.'],
                        ];
                    @endphp
                    @foreach($faqs as $index => [$question, $answer])
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                                    {{ $question }}
                                </button>
                            </h2>
                            <div id="faq{{ $index }}" class="accordion-collapse collapse {{ $index ? '' : 'show' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">{{ $answer }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="soft-card bg-white p-4 h-100">
                    <h2 class="h5 fw-bold">Besoin d'un compte ?</h2>
                    <p class="text-muted">Creez un espace patient pour planifier vos rendez-vous et suivre vos demandes.</p>
                    <a class="btn btn-primary w-100" href="{{ route('register.patient') }}">Creer un compte patient</a>
                    <a class="btn btn-outline-primary w-100 mt-2" href="{{ route('login') }}">Se connecter</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
