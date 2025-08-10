<div class="modal-content">
    <form id="create-complaint" method="POST" action="{{ route(auth()->user()->role . '.complaint.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
            <h5 class="modal-title text-uppercase">Add Complaint</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Complaint Message *</label>
                        <textarea type="text" class="form-control" name="message" id="message"required></textarea>
                        <div class="error-message text-danger"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Report</button>
        </div>
    </form>
</div>

<script>
    $('#create-complaint').ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {

        },
        success: function (responseText, statusText, xhr, $form) {
            var data = JSON.parse(responseText);
            $('#create-complaint .error-message').text("");
            if (data.status == "error") {
                $.each(data.errors, function (key, val) {
                    $('#create-complaint [name="' + key + '"]').closest('.form-group').find(
                        '.error-message').text(val);
                })
            } else if (data.status == "success") {
                $('#create-complaint')[0].reset();
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