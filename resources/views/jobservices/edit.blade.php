<div class="modal-content">
    <form id="edit-province" method="POST" action="{{ route('provinces.update', ['province' => $province]) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title text-uppercase">Edit Province</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Province *</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $province->name }}"
                            required>
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
    $('#edit-province').ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {

        },
        success: function (responseText, statusText, xhr, $form) {
            var data = JSON.parse(responseText);
            $('#edit-province .error-message').text("");
            if (data.status == "error") {
                $.each(data.errors, function (key, val) {
                    $('#edit-province [name="' + key + '"]').closest('.form-group').find(
                        '.error-message').text(val);
                })
            } else if (data.status == "success") {
                $('#edit-province')[0].reset();
                $('#province-modal').modal('hide');
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