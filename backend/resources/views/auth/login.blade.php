<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Prijava | Fitnes centar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0F0F12, #1C1C22);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .card-custom {
            width: 400px;
            background: #1C1C22;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }

        h3 {
            color: #FF8C00;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            color: #FFFFFF;
            font-weight: 500;
        }

        .form-control {
            background: #2A2A33;
            border: 1px solid #333;
            color: white;
        }

        .form-control:focus {
            background: #2A2A33;
            color: white;
            border-color: #FF8C00;
            box-shadow: 0 0 0 0.2rem rgba(255,140,0,0.25);
        }

        .btn-orange {
            background: #FF8C00;
            color: black;
            font-weight: bold;
            border: none;
        }

        .btn-orange:hover {
            background: #FFB347;
            color: black;
        }

        .form-check-label {
            color: #D1D1D6;
        }

        a {
            color: #FF8C00;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="card-custom">

    <h3>Prijava</h3>

    {{-- SESSION STATUS --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control"
                   required
                   autofocus>
        </div>

        <div class="mb-3">
            <label>Lozinka</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox"
                   class="form-check-input"
                   id="remember"
                   name="remember">
            <label class="form-check-label" for="remember">
                Zapamti me
            </label>
        </div>

        <button type="submit" class="btn btn-orange w-100">
            Prijavi se
        </button>

        <div class="text-center mt-2">
            <a href="{{ route('register') }}">
                Nemate nalog?
            </a>
        </div>

    </form>

</div>

</body>
</html>
