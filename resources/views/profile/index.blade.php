@extends('layouts.app')
@section('styles')
    <style>
        .profile-cover {
            background: url('{{ asset('backend/images/bg-profile.jpg') }}');
            height: 12rem;
            margin: -4.0rem -1.5rem -8.5rem -1.5rem;
        }
    </style>
@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 text-white">Account</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i
                                class="bx bx-home-alt text-white"></i></a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Provinces</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="profile-cover bg-dark"></div>

    <div class="modal fade" id="province-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-5 mx-auto">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img src="{{ asset('backend/images/user-thumbnail.png') }}" class="rounded-circle shadow"
                            width="120" height="120" alt="">
                    </div>
                    <div class="text-center mt-4">
                        <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                        @if (!empty(auth()->user()->job->job->name))
                            <h6 class="mb-1">{{ auth()->user()->job->job->name ?? "" }}</h6>
                        @endif
                        <p class="mb-0 text-secondary">{{ auth()->user()->email }}</p>
                        <p class="mb-0 text-secondary">
                            {{ $settings['country_dialing_code'] . ' ' . auth()->user()->phone ?? "" }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="POST" action="{{ route('account.update-profile') }}">
                        @csrf
                        <div class="card shadow-none border">
                            <div class="card-header">
                                <h6 class="mb-0">USER INFORMATION</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->email }}"
                                            disabled>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ auth()->user()->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Phone no.</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $settings['country_dialing_code'] }}</span>
                                            <input type="text" class="form-control field-phone" name="phone"
                                                value="{{ auth()->user()->phone }}" maxlength="10">
                                        </div>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <form method="POST" action="{{ route('account.change-password') }}">
                        @csrf
                        <div class="card shadow-none border">
                            <div class="card-header">
                                <h6 class="mb-0">CHANGE PASSWORD</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="form-group col-12">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <div class="position-relative">
                                            <input type="password" id="current_password" name="current_password" class="form-control"
                                                value="">
                                            <button type="button" class="togglePasswordBtn" tabindex="-1">
                                                <i class="bi bi-eye-fill togglePassword"></i>
                                            </button>
                                        </div>
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <div class="position-relative">
                                            <input type="password" id="new_password" name="new_password" class="form-control" value="">
                                            <button type="button" class="togglePasswordBtn" tabindex="-1">
                                                <i class="bi bi-eye-fill togglePassword"></i>
                                            </button>
                                        </div>
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="new_password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="position-relative">
                                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control"
                                                value="">
                                            <button type="button" class="togglePasswordBtn" tabindex="-1">
                                                <i class="bi bi-eye-fill togglePassword"></i>
                                            </button>
                                        </div>
                                        @error('new_password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--end row-->
@endsection