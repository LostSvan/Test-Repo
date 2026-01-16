<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body class="">

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom-custom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('tasks.index') }}">
                Mini Crm
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects.index') ? 'active fw-bold' : '' }}"
                           href="{{ route('projects.index') }}">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects.create') ? 'active fw-bold' : '' }}"
                           href="{{ route('projects.create') }}">Create Project</a>
                    </li>

                    <li class="nav-item ms-lg-3"></li> <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tasks.index') ? 'active fw-bold' : '' }}"
                           href="{{ route('tasks.index') }}">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tasks.create') ? 'active fw-bold' : '' }}"
                           href="{{ route('tasks.create') }}">Create Task</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
