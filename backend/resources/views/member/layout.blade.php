<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Member panel | Fitnes centar</title>

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

    .sidebar {
        min-height: 100vh;
        background: linear-gradient(180deg, #0F0F12, #1C1C22);
        border-right: 1px solid #2A2A33;
    }

    .sidebar h5 {
        color: var(--orange);
        font-weight: bold;
        letter-spacing: 1px;
    }

    .sidebar .nav-link {
        color: var(--light-gray);
        border-radius: 10px;
        padding: 12px 14px;
        transition: all 0.3s ease;
    }

    .sidebar .nav-link:hover {
        background-color: var(--mid-gray);
        color: var(--orange);
    }

    .card {
        background-color: var(--dark-gray);
        border: 1px solid #2A2A33;
        border-radius: 18px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .card-title {
        color: var(--light-gray);
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .btn-primary {
        background-color: var(--orange);
        border: none;
        color: var(--black);
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: var(--orange-soft);
        color: var(--black);
    }

    .alert-success {
        background-color: rgba(255, 140, 0, 0.15);
        color: var(--orange);
        border: none;
    }

    .text-muted {
        color: #D1D1D6 !important;
    }

    h2, h5 {
        text-shadow: 0 0 8px rgba(255, 140, 0, 0.35);
    }

    .rating input {
    display: none;
    }

    .rating label {
        font-size: 22px;
        color: #444;
        cursor: pointer;
    }

    .rating input:checked ~ label {
        color: #ffc107;
    }

    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <nav class="col-md-2 d-none d-md-block bg-dark sidebar text-white p-3 mt-5">


            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('member.dashboard') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('member.profile') }}" class="nav-link">
                        Profil
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('member.attendances') }}" class="nav-link">
                        Moji dolasci
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('member.personal.index') }}" class="nav-link">
                        Personalni treninzi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('member.group.index') }}" class="nav-link">
                        Grupni treninzi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('member.trainings.index') }}" class="nav-link">
                        Moji treninzi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('member.progress.index') }}" class="nav-link">
                        Moj napredak
                    </a>
                </li>


                <li class="nav-item mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light w-100">
                            Odjava
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <main class="col-md-10 ms-sm-auto px-4 py-4">

            @if (session('success'))
                <div class="alert alert-success" id="flash-message">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                        document.getElementById('flash-message').style.display = 'none';
                    }, 3000);
                </script>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
