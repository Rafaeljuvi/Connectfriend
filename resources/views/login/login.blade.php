@extends('layouts.auth')

@section('content')
<main class="d-flex w-100 h-100 bg-light">

    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-md-6 mx-auto d-flex align-items-center justify-content-center">
                <div class="card shadow-lg p-4 border-0" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="/images/logo.svg" alt="Logo" class="mb-3" style="width: 50px;">
                            <h2 class="fw-bold">Login to Your Account</h2>
                            <p class="text-muted">Stay connected. Stay secure.</p>
                        </div>
                        <form action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold">Email Address</label>
                                <input class="form-control @error('email') is-invalid @enderror" 
                                    type="email" name="email" placeholder="Enter your email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Enter your password">
                                <small class="d-block mt-2">
                                    Forgot password? <a href="{{ route('auth.password.request') }}" class="text-decoration-none">Reset it here</a>
                                </small>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Log In</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-muted">Don't have an account? <a href="{{ route('auth.register') }}" class="text-decoration-none">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
