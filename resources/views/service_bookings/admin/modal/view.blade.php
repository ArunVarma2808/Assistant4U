<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title text-uppercase">Booking Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col-md-12">
                <h6 class="mb-2">Booking Code: <span class="fw-bold">#{{ $booking->booking_code }}</span></h6>
                <h6 class="mb-2">Status: <span class="fw-bold text-uppercase">{{ $booking->status }}</span></h6>
            </div>
        </div>
        <div class="row">
            <!-- Customer Info -->
            <div class="col-md-6 mb-3">
                <div class="card h-100 border shadow-none">
                    <div class="card-header bg-light">
                        <strong>Customer</strong>
                    </div>
                    <div class="card-body">
                        <p class="fw-bold mb-1">{{ $booking->customer->name }}</p>
                        <p class="mb-0">{{ $booking->customer->email }}</p>
                        <p class="mb-0">
                            @if(isset($settings['country_dialing_code']))
                                {{ $settings['country_dialing_code'] . ' ' . $booking->customer->phone }}
                            @else
                                {{ $booking->customer->phone }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <!-- Staff Info -->
            <div class="col-md-6 mb-3">
                <div class="card h-100 border shadow-none">
                    <div class="card-header bg-light">
                        <strong>Staff</strong>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('backend/images/user-thumbnail.png') }}" class="rounded-circle shadow me-2" width="50" height="50" alt="">
                            <div>
                                <p class="fw-bold mb-1">{{ $booking->staff->name }}</p>
                                <p class="mb-0">{{ $booking->staff->email }}</p>
                                <p class="mb-0">
                                    @if(isset($settings['country_dialing_code']))
                                        {{ $settings['country_dialing_code'] . ' ' . $booking->staff->phone }}
                                    @else
                                        {{ $booking->staff->phone }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <p class="mb-1"><strong>Service:</strong> {{ $booking->staff->job->job->name ?? '-' }}</p>
                        <p class="mb-1"><strong>Charge:</strong>
                            @if(isset($settings['currency_symbol']))
                                {{ $settings['currency_symbol'] . ($booking->staff->job->service_charge ?? '-') }}/Hour
                            @else
                                {{ $booking->staff->job->service_charge ?? '-' }}/Hour
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Info -->
        <div class="row">
            <div class="col-md-12">
                <div class="card border shadow-none">
                    <div class="card-header bg-light">
                        <strong>Booking Info</strong>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>Booked for:</strong> {{ $booking->booking_date . ' at ' . $booking->booking_time }}</p>
                        <p class="mb-1"><strong>Address:</strong> {{ $booking->address }}</p>
                        <p class="mb-1"><strong>Message:</strong> {{ $booking->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>