@extends('auth.layout')
@section('content')
    <div class="wrapper">
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow rounded-0 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                                <img src="{{ asset('backend/images/error/login-img.jpg') }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6">
                                <form action="{{ route('signin.post') }}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <div class="card-body p-4 p-sm-5">
                                        <h5 class="card-title">Sign in to Assistant4U</h5>
                                        <p class="card-text mb-4">All in your service</p>
                                        <form class="form-body">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <div class="form-group ms-auto position-relative">
                                                        <div
                                                            class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                            <i class="bi bi-envelope-fill"></i>
                                                        </div>
                                                        <input type="email" class="form-control radius-30 ps-5" id="email"
                                                            name="email" placeholder="Email Address" value="{{ old('email') }}">
                                                    </div>
                                                    @error('email')
                                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="password" class="form-label">Enter Password</label>
                                                    <div class="form-group ms-auto position-relative">
                                                        <div
                                                            class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                            <i class="bi bi-lock-fill"></i>
                                                        </div>
                                                        <input type="password" class="form-control radius-30 ps-5"
                                                            id="password" name="password" placeholder="Enter Password">
                                                        <button type="button" class="togglePasswordBtn" tabindex="-1">
                                                            <i class="bi bi-eye-fill togglePassword"></i>
                                                        </button>
                                                    </div>
                                                    @error('password')
                                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 text-end">
                                                    <a href="{{ route('forgot-password') }}">Forgot Password ?</a>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary radius-30">Sign
                                                            In</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <p class="mb-2">Don't have an account yet? Sign up here</p>
                                                    <p class="mb-0">
                                                        <a href="{{ route('signup-page') }}">Customer</a> |
                                                        <a href="{{ route('signup-page-staff') }}">Working Staff</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection