@extends('layouts.auth-layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm border-all" style="width: 100%; max-width: 400px;">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-4">Login</h3>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control border-all"
                               placeholder="admin@mail.com"
                               value="{{ old('email') }}"
                               >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control border-all"
                               placeholder="Password"
                               >
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Log in</button>
                </form>

                <div class="text-center mt-3">
                    <span>Don't have a account? </span>
                    <a class="text-dark" href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection
