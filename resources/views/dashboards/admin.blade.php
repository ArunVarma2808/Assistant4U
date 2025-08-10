@extends('layouts.app')
@section('content')
    {{-- <div class="card shadow-none border">
        <div class="card-body"> --}}
            <h6>USER INFORMATION</h6>
            <hr>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 mb-3">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <h3>{{ $count['inactive_customers'] }}</h3>
                            <p class="mb-0">Inactive Customers</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-danger text-danger">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <h3>{{ $count['customers'] }}</h3>
                            <p class="mb-0">Active Customers</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-primary text-primary">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h3>{{ $count['staffs'] }}</h3>
                            <p class="mb-0">Active Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-danger text-danger">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h3>{{ $count['inactive_staffs'] }}</h3>
                            <p class="mb-0">Inactive Staffs</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-danger text-danger">
                                <i class="bi bi-cash"></i>
                            </div>
                            <h3>{{ $settings['currency_symbol'] . auth()->user()->balance }}</h3>
                            <p class="mb-0">Earnings</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100">
                                    <p>Active Customers</p>
                                    <h4 class="">{{ $count['customers'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100">
                                    <p>Inactive Customers</p>
                                    <h4 class="">{{ $count['inactive_customers'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100">
                                    <p>Active Working Staffs</p>
                                    <h4 class="">{{ $count['staffs'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100">
                                    <p>Inactive Working Staffs</p>
                                    <h4 class="">{{ $count['inactive_staffs'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100">
                                    <p>Bookings Pending</p>
                                    <h4 class="">{{ $count['pending_bookings'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-50">
                                    <p>Total Views</p>
                                    <h4 class="">12.5M</h4>
                                </div>
                                <div class="w-50">
                                    <p class="mb-3 float-end text-danger">- 3.4% <i class="bi bi-arrow-down"></i></p>
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-50">
                                    <p>Revenue</p>
                                    <h4 class="">$64.5K</h4>
                                </div>
                                <div class="w-50">
                                    <p class="mb-3 float-end text-success">+ 24% <i class="bi bi-arrow-up"></i></p>
                                    <div id="chart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-50">
                                    <p>Customers</p>
                                    <h4 class="">25.8K</h4>
                                </div>
                                <div class="w-50">
                                    <p class="mb-3 float-end text-success">+ 8.2% <i class="bi bi-arrow-up"></i></p>
                                    <div id="chart4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <h6>BOOKING INFORMATION</h6>
            <hr>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-xl-5 row-cols-xxl-5">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-info text-info">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h3>{{ $count['pending_bookings'] }}</h3>
                            <p class="mb-0">Bookings Pending</p>
                        </div>
                    </div>
                </div>
            </div>
            {{--
        </div>
    </div> --}}
@endsection