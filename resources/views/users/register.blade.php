@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">📝 Register</h3>

                    @include('layouts.alert')

                    <form method="POST" action="{{ route('users.register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Enter your name"
                                required
                            >
                        </div>

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
                                placeholder="Create a password"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Confirm your password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Register
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <span>Already have a account?</span>
                        <a href="/login" class="text-decoration-none fw-semibold">
                            Login
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
