@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Provinces</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Provinces</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-create">
                    <i class="m-0 bi bi-plus"></i> Add Province
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="province-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-province" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Province</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provinces as $province)
                            <tr>
                                <td>{{ $province->name }}</td>
                                <td>
                                    <form class="dlt-form" action="{{ route('provinces.delete', ['province' => $province]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm btn-edit"
                                                data-province-id="{{ $province->id }}">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#tbl-province').DataTable();

            $('.btn-create').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: `provinces/create`,
                    success: function (response) {
                        $('#province-modal .modal-dialog').html(response);
                        $('#province-modal').modal('show');
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.btn-edit').click(function (e) {
                e.preventDefault();
                const province = $(this).data('province-id');
                $.ajax({
                    type: "GET",
                    url: `provinces/${province}/edit`,
                    success: function (response) {
                        $('#province-modal .modal-dialog').html(response);
                        $('#province-modal').modal('show');
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.dlt-form').ajaxForm({
                beforeSubmit: function (formData, jqForm, options) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            return true
                        }
                    });
                    return false;
                },
                success: function (responseText, statusText, xhr, $form) {
                    return false;
                }
            })
        });
    </script>
@endsection