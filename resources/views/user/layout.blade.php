<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediStock | User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8fdf8;">
<nav class="navbar navbar-expand-lg navbar-light bg-success text-white px-3">
    <a class="navbar-brand text-white" href="{{ route('user.dashboard') }}">MediStock</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="{{ route('user.obat') }}" class="nav-link text-white">Data Obat</a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="btn btn-light btn-sm ms-3">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
<main class="p-4">
    @yield('content')
</main>

<!-- Bootstrap JS Bundle (termasuk Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
