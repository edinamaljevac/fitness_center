<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Admin panel | Fitnes centar</title>

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
        background: linear-gradient(
            180deg,
            #0F0F12,
            #1C1C22
        );
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

    main {
        background-color: var(--black);
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

.card small {
    color: #E5E5EA;
    font-size: 0.9rem;
}

.card p {
    color: #F2F2F7;
}

.card-title {
    color: #B0B0B8;
    font-weight: 600;
}

h2, h5 {
    text-shadow: 0 0 8px rgba(255, 140, 0, 0.35);
}

.card h1 {
    text-shadow: 0 0 12px rgba(255, 140, 0, 0.5);
}

.card p.text-muted {
    color: #ECECF1 !important;
    font-size: 0.95rem;
    line-height: 1.6;
}

</style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <nav class="col-md-2 d-none d-md-block bg-dark sidebar text-white p-3 mt-5">

            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.members.index') }}" class="nav-link text-white">
                        Članovi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.packages.index') }}" class="nav-link text-white">
                        Paketi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.memberships.index') }}" class="nav-link text-white">
                        Članstva
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link text-white">
                        Uplate
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.exercises.index') }}" class="nav-link text-white">
                        Vežbe
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reservations.index') }}" class="nav-link text-white">
                        Personalne rezervacije
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.group.index') }}" class="nav-link text-white">
                        Grupne prijave
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reports') }}"
                    class="nav-link text-white">
                        Izveštaji
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
