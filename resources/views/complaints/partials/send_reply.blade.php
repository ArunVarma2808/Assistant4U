<div class="modal-content">
    <form id="form-reply" method="POST" action="{{ route('complaint.reply.save', ['complaint' => $complaint]) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title text-uppercase">Send Reply</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label class="form-label">Complaint Message</label>
                        <textarea class="form-control" readonly>{{ $complaint->message }}</textarea>
                        <div class="error-message text-danger"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="reply" class="form-label">Reply Message</label>
                        <textarea class="form-control" id="reply" name="reply" required></textarea>
                        <div class="error-message text-danger"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>

<script>
    $('#form-reply').ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {

        },
        success: function (responseText, statusText, xhr, $form) {
            var data = JSON.parse(responseText);
            $('#form-reply .error-message').text("");
            if (data.status == "error") {
                $.each(data.errors, function (key, val) {
                    $('#form-reply [name="' + key + '"]').closest('.form-group').find(
                        '.error-message').text(val);
                })
            } else if (data.status == "success") {
                $('#form-reply')[0].reset();
                $('#complaint-modal').modal('hide');
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