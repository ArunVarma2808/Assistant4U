@extends('layouts.app')
@section('styles')

@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Job & Service Locations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Job & Service Locations</li>
                </ol>
            </nav>
        </div>
        {{-- <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-create">
                    <i class="m-0 bi bi-plus"></i> Add Job Service
                </button>
            </div>
        </div> --}}
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <h6 class="mb-0">Job</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('staff.save_job_update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="job_id" class="form-label">Job</label>
                            <select name="job_id" id="job_id" class="form-control multi-select" data-allow-clear="true"
                                data-placeholder="Select Provinces" disabled>
                                <option>Select Job</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" {{ (old('job_id') ?? $current_job->job->id) == $job->id ? 'selected' : '' }}>{{ $job->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('job_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="license" class="form-label">Job ID / License / Certification</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="license" name="license" />
                                <a class="btn btn-secondary input-group-text" target="_blank"
                                    href="{{ asset('/storage/' . $current_job->license) }}">View</a>
                            </div>
                        </div>
                        @error('job_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="license" class="form-label">Service Charge</label>
                            <div class="input-group">
                                <input type="text" class="form-control number-only" name="service_charge"
                                    id="service_charge" placeholder="Service Charge" min="1"
                                    value="{{ $current_job->service_charge }}" />
                                <span class="input-group-text">{{ $settings['currency_code'] }}/Hour</span>
                            </div>
                        </div>
                        @error('job_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="ms-auto col-md-2">
                        <div class="mb-2">
                            <button class="btn btn-primary w-100" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Service Locations</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('staff.save_job_location_update') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="provinces" class="form-label">Provinces</label>
                            <select name="provinces[]" id="provinces" class="form-control multi-select"
                                data-allow-clear="true" data-placeholder="Select Provinces" multiple>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ in_array($province->id, (old('provinces') ?? $provinceIds)) ? 'selected' : '' }}>{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('provinces')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="regions" class="form-label">Regions</label>
                            <select name="regions[]" id="regions" class="form-control multi-select" data-allow-clear="true"
                                data-placeholder="Select Regions" multiple>
                            </select>
                            @error('regions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="ms-auto col-md-2">
                        <div class="mb-2">
                            <button class="btn btn-primary w-100" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });

            $('.multi-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });

            $('#provinces').change(function (e) {
                e.preventDefault();
                const province_ids = $(this).val();
                $.ajax({
                    type: "GET",
                    data: {
                        province_ids: province_ids
                    },
                    url: `job-update/get-staff-regions`,
                    success: function (response) {
                        if (response?.status == 'success') {
                            let html = ``;
                            $.each(response?.provinces, function (index1, value1) {
                                html += `<optgroup label="${value1.name}">`;
                                $.each(value1?.regions, function (index2, value2) {
                                    html += `<option value="${value2.id}" ${value2.is_selected ? 'selected' : ''}>${value2.name}</option>`;
                                });
                                html += `</optgroup>`;
                            });
                            $('#regions').html(html).trigger('change');
                        }
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            })

            $('#provinces').trigger('change');
        });
    </script>
@endsection