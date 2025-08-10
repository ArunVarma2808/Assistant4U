<div class="modal-content">
    <form id="book-service-form" method="POST" action="{{ route('user.book.service', ['user' => $user]) }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
            <h5 class="modal-title text-uppercase">Book Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-avatar text-center">
                        <img src="{{ asset('backend/images/user-thumbnail.png') }}" class="rounded-circle shadow" width="150"
                            height="150" alt="">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group mb-3">
                        <h3>{{ $user->name }}</h3>
                        <input type="hidden" name="staff_id" value="{{ $user->id }}">
                        <p class="mb-1">{{ $user->job->job->name }}</p>
                        <p><strong>Service locations:</strong> {{ implode(', ', $user->jobLocation->pluck('region.name')->toArray()) }}</p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="booking_date">Date and Time for Booking</label>
                        <div class="input-group">
                            <input type="date" name="booking_date" id="booking_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                            <input type="time" name="booking_time" id="booking_time" class="form-control" min="{{ date('H:i') }}" value="{{ date('H:i') }}">
                        </div>
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="booking_address"> Address</label>
                        <input type="text" name="address" id="booking_address" class="form-control">
                        <span class="error-message text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="booking_address"> Message</label>
                        <textarea name="message" id="booking_message" class="form-control"></textarea>
                        <span class="error-message text-danger"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Book</button>
        </div>
    </form>
</div>

<script>
    $('#book-service-form').ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {

        },
        success: function (responseText, statusText, xhr, $form) {
            let data = JSON.parse(responseText);
            console.log(data);
            $('#book-service-form .error-message').text("");
            if (data.status == "error") {
                $.each(data.errors, function (key, val) {
                    $('#book-service-form [name="' + key + '"]').closest('.form-group').find(
                        '.error-message').text(val);
                })
            } else if (data.status == "success") {
                $('#book-service-form')[0].reset();
                $('#booking-modal').modal('hide');
                Swal.fire({
                    title: data?.message,
                    icon: "success"
                }).then((result) => {
                    window.location.reload();
                });
            }
        },
        error: function (xhr, status, error) {
            console.log(error, xhr, status);
        }
    }); 
</script>