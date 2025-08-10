@extends('layouts.app')
@section('content')
    <h6>BOOKING INFORMATION</h6>
    <hr>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-6 row-cols-xxl-6">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                        <i class="bi bi-journal-arrow-down"></i>
                    </div>
                    <h3>{{ $count['pending_bookings'] }}</h3>
                    <p class="mb-0">Bookings Pending</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-info text-info">
                        <i class="bi bi-journal-medical"></i>
                    </div>
                    <h3>{{ $count['confirmed_bookings'] }}</h3>
                    <p class="mb-0">Bookings Confirmed</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-danger text-danger">
                        <i class="bi bi-journal-x"></i>
                    </div>
                    <h3>{{ $count['rejected_bookings'] }}</h3>
                    <p class="mb-0">Bookings Rejected</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-dark text-dark-light">
                        <i class="bi bi-journal-minus"></i>
                    </div>
                    <h3>{{ $count['cancelled_bookings'] }}</h3>
                    <p class="mb-0">Bookings Cancelled</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-warning text-warning">
                        <i class="bi bi-journal"></i>
                    </div>
                    <h3>{{ $count['expired_bookings'] }}</h3>
                    <p class="mb-0">Bookings Expired</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-success text-success">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <h3>{{ $count['completed_bookings'] }}</h3>
                    <p class="mb-0">Bookings Completed</p>
                </div>
            </div>
        </div>
    </div>
@endsection