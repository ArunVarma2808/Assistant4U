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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-booking" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Staff</th>
                            <th>Customer</th>
                            <th>Booked for</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->booking_code }}</td>
                                <td>
                                    <p class="fw-bold mb-1">{{ $booking->customer->name }}</p>
                                </td>
                                <td>
                                    <p class="fw-bold mb-1">{{ $booking->staff->name }}</p>
                                </td>
                                <td>{{ $booking->booking_date . ' at ' . $booking->booking_time }}</td>
                                <td class="text-uppercase">{{ $booking->status }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary view-booking" data-id="{{ $booking->id }}">
                                        <i class="m-0 bi bi-eye"></i> Show Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="view-booking-modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#tbl-booking').DataTable({
                order: []
            });

            $('.view-booking').on('click', function (e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "service-bookings/view/" + id,
                    success: function (response) {
                        $('#view-booking-modal .modal-dialog').html(response);
                        $('#view-booking-modal').modal('show');
                    }
                });
            });
        });
    </script>
@endsection