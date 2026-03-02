<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Registracija | Fitnes centar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white d-flex align-items-center justify-content-center" style="min-height:100vh;">

<div class="card p-4 shadow-lg" style="width:400px; background:#1C1C22; border-radius:15px;">

    <h3 class="text-center mb-4" style="color:#FF8C00;">
        Registracija
    </h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label text-white">Ime i prezime</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Lozinka</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Potvrdi lozinku</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label text-white">Uloga</label>
            <select name="role" class="form-select" required>
                <option value="">-- Izaberite ulogu --</option>
                <option value="member">Član</option>
                <option value="trainer">Trener</option>
            </select>
        </div>

        <button type="submit" class="btn w-100"
                style="background:#FF8C00; color:black; font-weight:bold;">
            Registruj se
        </button>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-light">
                Već imate nalog?
            </a>
        </div>
    </form>

</div>

</body>
</html>
