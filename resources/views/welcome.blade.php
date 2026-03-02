<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>IS Fitnes Centra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root {
        --black: #0F0F12;
        --dark-gray: #1C1C22;
        --mid-gray: #2A2A33;
        --light-gray: #B5B5C3;
        --orange: #FF8C00;
        --orange-soft: #FFB347;
        --white: #FFFFFF;
    }

    body {
        background-color: var(--black);
        color: var(--white);
    }

    .hero {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .hero h1 {
        color: var(--orange);
        font-weight: bold;
        text-shadow: 0 0 12px rgba(255,140,0,0.4);
    }

    .feature-card {
        background-color: var(--dark-gray);
        border: 1px solid #2A2A33;
        border-radius: 18px;
        padding: 30px;
        transition: 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        border-color: var(--orange);
    }

    .feature-card h5 {
        color: var(--orange);
        font-weight: bold;
    }

    .btn-orange {
        background-color: var(--orange);
        border: none;
        color: var(--black);
        font-weight: bold;
        padding: 12px 28px;
        border-radius: 10px;
    }

    .btn-orange:hover {
        background-color: var(--orange-soft);
        color: var(--black);
    }

    .top-nav {
        background: linear-gradient(180deg, #0F0F12, #1C1C22);
        border-bottom: 1px solid #2A2A33;
    }

    .top-nav a {
        color: var(--light-gray);
        text-decoration: none;
        margin-left: 20px;
        transition: 0.3s;
    }

    .top-nav a:hover {
        color: var(--orange);
    }

    footer {
        border-top: 1px solid #2A2A33;
        color: var(--light-gray);
    }
    .text-muted {
        color: #EAEAF0 !important;
        opacity: 0.9;
    }
    </style>
</head>
<body>

<nav class="top-nav py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-orange" style="color: var(--orange); font-weight: bold;">
            IS Fitnes Centra
        </h5>

        <div>
            @auth
                @php $role = auth()->user()->role; @endphp

                @if($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                @elseif($role === 'trainer')
                    <a href="{{ route('trainer.dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('member.dashboard') }}">Dashboard</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-outline-light ms-3">Odjava</button>
                </form>
            @else
                <a href="{{ route('login') }}">Prijava</a>
                <a href="{{ route('register') }}">Registracija</a>
            @endauth
        </div>
    </div>
</nav>

<section class="hero container">
    <div>
        <h1 class="display-4 mb-4">
            Informacioni sistem fitnes centra
        </h1>

        <p class="lead text-muted mb-5">
            Digitalno upravljanje članovima, trenerima, treninzima,
            paketima i napretkom – sve na jednom mestu.
        </p>

        @guest
            <a href="{{ route('register') }}" class="btn btn-orange">
                Započni sada
            </a>
        @endguest
    </div>
</section>

<section class="container pb-5">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="feature-card text-center">
                <h5>Upravljanje članovima</h5>
                <p class="text-muted">
                    Evidencija članstva, statusa, paketa,
                    dolazaka i istorije aktivnosti.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-card text-center">
                <h5>Praćenje treninga</h5>
                <p class="text-muted">
                    Personalni i grupni treninzi,
                    evidencija vežbi i napretka članova.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-card text-center">
                <h5>Izveštaji i analiza</h5>
                <p class="text-muted">
                    Statistika dolazaka i analiza razvoja članova.
                </p>
            </div>
        </div>

    </div>
</section>

<footer class="text-center py-4">
    © {{ date('Y') }} IS Fitnes Centra – Softversko inženjerstvo
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>