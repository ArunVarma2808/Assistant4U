@extends('auth.layout')
@section('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
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
                                <div class="card-body p-4 p-sm-5">
                                    <h5 class="card-title">Sign up to Assistant4U</h5>
                                    <p class="card-text mb-4">Customer Portal</p>
                                    <form action="{{ route('signup-user.post') }}" method="POST" class="form-body">
                                        @csrf
                                        @method('POST')
                                        <div class="row g-3">
                                            <div class="col-12 ">
                                                <label for="name" class="form-label">Full Name</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-person-circle"></i>
                                                    </div>
                                                    <input type="text" class="form-control radius-30 ps-5" id="name"
                                                        name="name" placeholder="Full Name" required>
                                                </div>
                                                @error('name')
                                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12 ">
                                                <label for="phone" class="form-label">Phone no.</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="input-group">
                                                        <span
                                                            class="input-group-text ps-5 radius-30">{{ $settings['country_dialing_code'] }}</span>
                                                        <input type="text" class="form-control radius-30 field-phone"
                                                            id="phone" name="phone" placeholder="Phone no."
                                                            value="{{ old('phone') }}" maxlength="10">
                                                    </div>
                                                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"
                                                        style="z-index: 9;">
                                                        <i class="bi bi-phone-fill"></i>
                                                    </div>
                                                </div>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email Address</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                    <input type="email" class="form-control radius-30 ps-5" id="email"
                                                        name="email" placeholder="Email Address" value="{{ old('email') }}"
                                                        required>
                                                </div>
                                                @error('email')
                                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Enter Password</label>
                                                <div class="ms-auto position-relative" required>
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </div>
                                                    <input type="password" class="form-control radius-30 ps-5" id="password"
                                                        name="password" placeholder="Enter Password">
                                                </div>
                                                @error('password')
                                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary radius-30">Sign up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-0 text-center">Already have an account?
                                                    <a href="{{ route('signin-page') }}">Sign in</a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('scripts')
@endsection