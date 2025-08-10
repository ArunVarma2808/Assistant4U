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
                    <div class="card shadow rounded-0 overflow-hidden mb-0">
                        <div class="row g-0">
                            <div class="col-12">
                                <div class="card-body p-4 p-sm-5">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Sign up to Assistant4U</h5>
                                            <p class="card-text mb-4">Staff Portal</p>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="card-text mb-0">
                                                {{ $settings['currency_symbol'] . $settings['subscription_amount'] . '/' . $settings['subscription_period'] . 'days' }}
                                            </h5>
                                            <span class="badge bg-primary">Subscribe now</span>
                                        </div>
                                    </div>
                                    <form method="post" action="{{ route('signup-staff.post') }}"
                                        enctype="multipart/form-data" class="form-body">
                                        @csrf
                                        @method('POST')
                                        <div class="row g-3 justify-content-center">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-person-circle"></i>
                                                    </div>
                                                    <input type="text" class="form-control radius-30 ps-5" id="name"
                                                        name="name" placeholder="Enter Name" value="{{ old('name') }}">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone no.</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="input-group">
                                                        <span class="input-group-text ps-5 radius-30">{{ $settings['country_dialing_code'] }}</span>
                                                        <input type="text" class="form-control field-phone radius-30"
                                                            id="phone" name="phone" placeholder="Phone no."
                                                            value="{{ old('phone') }}" maxlength="10">
                                                    </div>
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3" style="z-index: 9;">
                                                        <i class="bi bi-phone-fill"></i>
                                                    </div>
                                                </div>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email Address</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                    <input type="email" class="form-control radius-30 ps-5" id="email"
                                                        name="email" placeholder="Email Address" value="{{ old('email') }}">
                                                </div>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Enter Password</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </div>
                                                    <input type="password" class="form-control radius-30 ps-5" id="password"
                                                        name="password" placeholder="Enter Password">
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                                <h6>Job and Service Location</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="job_id" class="form-label">Job</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-briefcase-fill"></i>
                                                    </div>
                                                    <select name="job_id" id="job_id"
                                                        class="form-control radius-30 ps-5 select2">
                                                        <option value="" selected disabled hidden>Select Job</option>
                                                        @foreach ($jobs as $job)
                                                            <option value="{{ $job->id }}" {{ old('job_id') == $job->id ? 'selected' : '' }}>{{ $job->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('job_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="license" class="form-label">Job ID / License /
                                                    Certification</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-file-fill"></i>
                                                    </div>
                                                    <input type="file" class="form-control radius-30 ps-5" id="license"
                                                        name="license" />
                                                </div>
                                                @error('license')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="service_charge" class="form-label">Service Charge</label>
                                                <div class="ms-auto position-relative">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control number-only radius-30 ps-5"
                                                            name="service_charge" id="service_charge"
                                                            placeholder="Service Charge" min="1" />
                                                        <span
                                                            class="input-group-text radius-30">{{ $settings['currency_code'] }}/Hour</span>
                                                    </div>
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3" style="z-index: 9;">
                                                        <i class="bi bi-cash-coin"></i>
                                                    </div>
                                                </div>
                                                @error('service_charge')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="province_id" class="form-label">Province</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-map-fill"></i>
                                                    </div>
                                                    <select name="province_id" id="province_id"
                                                        class="form-control radius-30 ps-5 select2">
                                                        <option value="" selected disabled hidden>Select Province</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                                                {{ $province->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('province_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="region_id" class="form-label">Region</label>
                                                <div class="ms-auto position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-pin-map-fill"></i>
                                                    </div>
                                                    <select name="region_id" id="region_id"
                                                        class="form-control radius-30 ps-5 select2">
                                                        <option value="" selected disabled hidden>Select Region</option>
                                                    </select>
                                                </div>
                                                @error('region_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary radius-30">Subscribe & Sign
                                                        up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-0 text-center">Already have an account? <a
                                                        href="{{ route('signin-page') }}">Sign in</a></p>
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
    <script>
        $(document).ready(function () {
            $('#province_id').change(function (e) {
                e.preventDefault();
                const province = $(this).val();
                if (!province)
                    return
                let html = '<option value="" selected disabled hidden>Select Region</option>';
                $.ajax({
                    type: "GET",
                    url: `/province/${province}/get-regions`,
                    dataType: "JSON",
                    success: function (response) {
                        $.each(response, function (index, region) {
                            html += `<option value="${region.id}">${region.name}</option>`;
                        });
                        $('#region_id').html(html);
                    },
                    error: function (e) {
                        console.error(e);
                        $('#region_id').html(html);
                    },
                });
            });
            setTimeout(() => {
                $('#province_id').trigger('change');
            }, 0);
        });
    </script>
@endsection