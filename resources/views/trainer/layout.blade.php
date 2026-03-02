<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Trainer panel | Fitnes centar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root {
        --black: #0F0F12;
        --dark-gray: #1C1C22;
        --mid-gray: #2A2A33;
        --light-gray: #B5B5C3;
        --orange: #FF8C00;
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
    }
    </style>
</head>
<body>

<div class="container-fluid">
<div class="row">

<nav class="col-md-2 sidebar p-3 mt-5">
    <ul class="nav flex-column gap-2">
        <li class="nav-item">
            <a href="{{ route('trainer.dashboard') }}" class="nav-link">
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('trainer.profile') }}" class="nav-link">
                Profil
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('trainer.slots.index') }}" class="nav-link">
             Personalni termini
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('trainer.group.index') }}" class="nav-link">
                Grupni treninzi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('trainer.members.index') }}" class="nav-link">
                Klijenti
            </a>
        </li>

        <li class="nav-item">
        <a href="{{ route('trainer.trainings.index') }}"
        class="nav-link">
            Treninzi
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

<main class="col-md-10 px-4 py-4">
    @yield('content')
</main>

</div>
</div>

</body>
</html>
