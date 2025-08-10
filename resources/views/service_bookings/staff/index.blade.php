@extends('layouts.app')
@section('styles')
    <style>
        .icon-box>img {
            width: 100%;
            height: 100%;
            aspect-ratio: 1/1;
        }

        input.field-earnings::-webkit-outer-spin-button,
        input.field-earnings::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input.field-earnings[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bookings</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Bookings</li>
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

    <div id="bookings">
        @forelse ($bookings as $booking)
            <div class="card">
                <div class="card-header py-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-xl-4 col-md-6 me-auto">
                            <h5 class="mb-1">Booking Code: #{{ $booking->booking_code }}</h5>
                            <p class="mb-0">Booked for: {{ $booking->booking_date . ' at ' . $booking->booking_time }}</p>
                        </div>
                        <div class="col-12 col-xl-6 text-end">
                            @if ($booking->status == 'pending')
                                <form class="d-inline-block" action="{{ route('staff.bookings.update', ['booking' => $booking->id]) }}" method="POST"
                                    class="cancel-form">
                                    @csrf
                                    @method('put')
                                    <button type="submit" name="status" value="confirmed" class="btn btn-primary">Confirm</button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                                </form>
                            @elseif ($booking->status == 'confirmed')
                                <form class="d-xl-inline-block" action="{{ route('staff.bookings.update', ['booking' => $booking->id]) }}" method="POST"
                                    class="complete-form">
                                    @csrf
                                    @method('put')
                                    <div class="input-group">
                                        <span class="input-group-text">Amount charged</span>
                                        <input type="number" class="form-control field-earnings" name="amount_earned"
                                            placeholder="0.00" value="" />
                                        <button type="submit" name="status" value="completed" class="btn btn-primary">Save &
                                            Complete</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border shadow-none radius-10 h-100 mb-0">
                                <div class="card-body">
                                    <div class="d-flex gap-3">
                                        <div class="icon-box bg-light-primary border overflow-hidden">
                                            <img src="{{ asset('backend/images/user-thumbnail.png') }}" alt="">
                                        </div>
                                        <div class="info">
                                            <h6 class="mb-2">{{ $booking->customer->name }}</h6>
                                            <p class="mb-1">{{  $settings['country_dialing_code'] . ' ' . $booking->customer->phone }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border shadow-none radius-10 h-100 mb-0">
                                <div class="card-body">
                                    <div class="d-flex gap-3">
                                        <div class="icon-box bg-light-danger border-0">
                                            <i class="bi bi-geo-alt text-danger"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="mb-2">Booking Info</h6>
                                            <p class="mb-1"><strong>Address</strong> : {{ $booking->address }}</p>
                                            <p class="mb-1"><strong>Message</strong> : {{ $booking->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <span class="input-group-text">Status</span>
                                <input type="text" class="form-control" value="{{ ucwords($booking->status) }}"
                                    style="box-shadow: none" readonly>
                                @if ($booking->status == 'completed')
                                    <span class="input-group-text">Amount charged</span>
                                    <input type="text" class="form-control" value="{{ number_format((float)$booking->earnings, 2, '.', '') }}"
                                        style="box-shadow: none; max-width: 120px;" readonly>
                                @endif
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        @empty
            <div class="card shadow-none border">
                <div class="card-body text-center">
                    <image class="mb-3" src="{{ asset('backend/images/no-record.svg') }}" alt="no-bookings-found" width="150"
                        height="150">
                        <h6 class="mb-0"><i class="bi bi-info-circle"></i> No booking found</h6>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').each(function () {
                $(this).select2({
                    width: 'auto',
                    placeholder: $(this).data('placeholder'),
                    allowClear: true
                });
            });
        });
        $('.cancel-form').on('submit', function (e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                theme: localStorage.getItem('theme'),
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection