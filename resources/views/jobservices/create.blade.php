<div class="modal-content">
    <form id="create-jobservice" method="POST" action="{{ route('job_services.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
            <h5 class="modal-title text-uppercase">Add Job Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Job Service *</label>
                        <input type="text" class="form-control" name="name" id="name" value="" required>
                        <div class="error-message text-danger"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<script>
    $('#create-jobservice').ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {

        },
        success: function (responseText, statusText, xhr, $form) {
            var data = JSON.parse(responseText);
            $('#create-jobservice .error-message').text("");
            if (data.status == "error") {
                $.each(data.errors, function (key, val) {
                    $('#create-jobservice [name="' + key + '"]').closest('.form-group').find(
                        '.error-message').text(val);
                })
            } else if (data.status == "success") {
                $('#create-jobservice')[0].reset();
                $('#jobservice-modal').modal('hide');
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