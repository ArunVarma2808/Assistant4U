<div class="modal-content">
    <form id="create-region" method="POST" action="{{ route('regions.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-header">
            <h5 class="modal-title text-uppercase">Add Region</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="province_id" class="form-label">Province *</label>
                        <select class="form-control single-select" name="province_id" id="province_id" data-allow-clear="true" data-placeholder="Select Province">
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Region *</label>
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
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
        dropdownParent: $('.modal')
    });

    $('#create-region').ajaxForm({
        beforeSubmit: function (formData, jqForm, options) {

        },
        success: function (responseText, statusText, xhr, $form) {
            var data = JSON.parse(responseText);
            $('#create-region .error-message').text("");
            if (data.status == "error") {
                $.each(data.errors, function (key, val) {
                    $('#create-region [name="' + key + '"]').closest('.form-group').find(
                        '.error-message').text(val);
                })
            } else if (data.status == "success") {
                $('#create-region')[0].reset();
                $('#region-modal').modal('hide');
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