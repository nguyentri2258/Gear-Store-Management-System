@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">🔐 Login</h3>

                    @include('layouts.alert')

                    <form method="POST" action="{{ route('users.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <span>Haven't had a account yet?</span>
                        <a href="/register" class="text-decoration-none fw-semibold">
                            Register
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
