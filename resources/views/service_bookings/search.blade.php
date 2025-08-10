@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Find Service</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Find Services</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
        </div>
    </div>

    <div class="modal fade" id="province-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <form class="row">
                <div class="col-12">
                    <label class="mb-2">Search Service</label>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="service" id="service_id" class="form-control select2" data-placeholder="Search Service" data-allow-clear="true">
                        <option></option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ $service->id == $selected_service ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="province" id="province_id" class="form-control select2" data-placeholder="Search Province" data-allow-clear="true">
                        <option></option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ $province->id == $selected_province ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="region" id="region_id" class="form-control select2" data-placeholder="Search Region" data-allow-clear="true">
                        <option></option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}" {{ $region->id == $selected_region ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-primary btn-find rounded w-100">
                        <i class="m-0 bi bi-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="product-grid">
                <div class="row row-cols-1 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-3">
                    @foreach ($users as $user)
                        <div class="col">
                            <div class="card border shadow-none mb-0 overflow-hidden">
                                <img src="{{ asset('backend/images/user-thumbnail.png') }}" class="img-fluid mb-0" alt="" />
                                <div class="card-body text-center">
                                    <h6 class="product-title">{{ $user->name }}</h6>
                                    <div>
                                        <span>{{ $user->job->job->name }}</span>
                                    </div>
                                    <p class="product-price fs-5 mb-1"><span>{{ $settings['currency_symbol'] }}{{ $user->job->service_charge }}/Hour</span></p>
                                    {{-- <div class="rating mb-0">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </div>
                                    <small>74 Reviews</small> --}}
                                    <div class="actions d-flex align-items-center justify-content-center gap-2 mt-3">
                                        <button type="button" class="btn btn-sm btn-book btn-outline-primary" data-user="{{ $user->id }}">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="modal fade" id="booking-modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').each(function () {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });

            $('#province_id').change(function (e) {
                e.preventDefault();
                let html = '<option></option>';
                const province = $(this).val();
                if (!province) {
                    $('#region_id').html(html);
                    return
                }
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

            $('.btn-book').click(function (e) {
                e.preventDefault();
                const user = $(this).data('user');
                $.ajax({
                    type: "GET",
                    url: `view-service/${user}`,
                    success: function (response) {
                        $('#booking-modal .modal-dialog').html(response);
                        $('#booking-modal').modal('show');
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection