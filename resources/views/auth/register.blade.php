@extends('layouts.auth-layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm border-all" style="width: 100%; max-width: 500px;">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-4">Registration</h3>

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror border-all"
                               placeholder="Your name"
                               value="{{ old('name') }}"
                               >
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror border-all"
                               placeholder="user@mail.com"
                               value="{{ old('email') }}"
                               >
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror border-all"
                               placeholder="Password"
                               >
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Repeat password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control border-all"
                               placeholder="Confirm your password"
                               >
                    </div>

                    <button type="submit" class="btn btn-dark w-100 btn-lg">Sign up</button>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="text-decoration-none text-dark">Already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
