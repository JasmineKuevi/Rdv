<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Medilink')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --medilink-blue: #075aa8;
            --medilink-blue-dark: #08345f;
            --medilink-sky: #eaf5ff;
            --medilink-gold: #f6b93b;
            --medilink-ink: #122033;
        }

        body {
            padding-top: 70px;
            background: #f6f8fb;
            color: var(--medilink-ink);
            font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .public-navbar {
            background: rgba(7, 90, 168, .97);
            box-shadow: 0 10px 30px rgba(7, 36, 74, .16);
        }

        .public-navbar .navbar-brand {
            letter-spacing: .2px;
        }

        .public-navbar .nav-link {
            font-weight: 600;
        }

        .public-navbar .dropdown-menu {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 18px 40px rgba(15, 34, 58, .15);
        }

        .section-title {
            color: var(--medilink-blue-dark);
            font-weight: 800;
        }

        .soft-card {
            border: 1px solid rgba(13, 59, 102, .08);
            border-radius: 8px;
            box-shadow: 0 12px 35px rgba(18, 32, 51, .08);
        }

        .btn-primary {
            background: var(--medilink-blue);
            border-color: var(--medilink-blue);
        }

        .btn-primary:hover {
            background: #064d90;
            border-color: #064d90;
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <strong>Veuillez corriger les champs suivants :</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="border-top py-4 bg-white">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2 small text-muted">
            <span>&copy; {{ date('Y') }} Medilink. Tous droits reserves.</span>
            <span>
                <a href="{{ route('aide') }}" class="text-decoration-none">Aide</a>
                <span class="mx-2">.</span>
                <a href="{{ route('apropos') }}" class="text-decoration-none">A propos</a>
            </span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
