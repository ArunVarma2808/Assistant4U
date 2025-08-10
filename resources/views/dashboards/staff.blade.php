@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (!auth()->user()->is_subscribed)
                        <form action="{{ route('staff.renew_subscription') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col d-flex align-items-center gap-3">
                                    <div class="widget-icon mb-3 bg-light-danger text-danger" style="min-width: 48px;">
                                        <i class="bi bi-bell"></i>
                                    </div>
                                    <div>
                                        <h5>Your subscription plan has expired</h5>
                                        <p class="text-secondary">Your service is no longer visible to the public. Please renew
                                            your
                                            subscription to continue using the service.</p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="d-flex flex-column justify-content-center h-100">
                                        <div class="text-center text-sm-end mb-1 text-nowrap">
                                            <h5 class="card-text mb-0">
                                                {{ $settings['currency_symbol'] . $settings['subscription_amount'] . '/' . $settings['subscription_period'] . 'days' }}
                                            </h5>
                                        </div>
                                        <button class="btn btn-primary rounded">Renew</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="row">
                            <div class="col d-flex align-items-center gap-3">
                                <div class="widget-icon mb-3 bg-light-success text-success" style="min-width: 48px;">
                                    <i class="bi bi-bell"></i>
                                </div>
                                <div>
                                    <h5>Your subscription is active</h5>
                                    <p class="text-secondary">Valid until {{ \Carbon\Carbon::parse(auth()->user()->subscription_expires_at)->format('Y-m-d') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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
        <div class="col">
            <div class="card radius-10">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <h3>{{ $settings['currency_symbol'] . $count['earnings'] }}</h3>
                    <p class="mb-0">Total earnings</p>
                </div>
            </div>
        </div>
    </div>
@endsection