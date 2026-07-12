<nav class="navbar navbar-expand-lg navbar-dark fixed-top public-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Medilink</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Ouvrir le menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="publicNavbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('medecins.*') || request()->routeIs('specialites.*') || request()->routeIs('centres-sante.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Parcourir
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('medecins.index') }}">Medecins</a></li>
                        <li><a class="dropdown-item" href="{{ route('specialites.index') }}">Specialites</a></li>
                        <li><a class="dropdown-item" href="{{ route('centres-sante.index') }}">Centres de sante</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('aide') ? 'active' : '' }}" href="{{ route('aide') }}">Aide</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('apropos') ? 'active' : '' }}" href="{{ route('apropos') }}">A propos</a>
                </li>
            </ul>

            <div class="d-flex align-items-lg-center gap-2 flex-column flex-lg-row">
                <a class="btn btn-outline-light btn-sm" href="{{ route('login', ['role' => 'patient']) }}">Connexion</a>
                <a class="btn btn-warning btn-sm fw-semibold" href="{{ route('register.patient') }}">Creer un compte</a>
            </div>
        </div>
    </div>
</nav>
