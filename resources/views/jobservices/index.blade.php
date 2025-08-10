@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Job Services</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Job Services</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-create">
                    <i class="m-0 bi bi-plus"></i> Add Job Service
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="jobservice-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-jobservice" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Job Service</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobservices as $jobservice)
                            <tr>
                                <td>{{ $jobservice->name }}</td>
                                <td>
                                    <form class="dlt-form"
                                        action="{{ route('job_services.delete', ['jobservice' => $jobservice]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm btn-edit"
                                                data-jobservice-id="{{ $jobservice->id }}">
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
            $('#tbl-jobservice').DataTable();

            $('.btn-create').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: `job-services/create`,
                    success: function (response) {
                        $('#jobservice-modal .modal-dialog').html(response);
                        $('#jobservice-modal').modal('show');
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.btn-edit').click(function (e) {
                e.preventDefault();
                const jobservice = $(this).data('jobservice-id');
                $.ajax({
                    type: "GET",
                    url: `job-services/${jobservice}/edit`,
                    success: function (response) {
                        $('#jobservice-modal .modal-dialog').html(response);
                        $('#jobservice-modal').modal('show');
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.dlt-form').on('submit', function (e) {
                e.preventDefault();
                const form = this;
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
                        $(form).ajaxSubmit({
                            success: function (responseText, statusText, xhr, $form) {
                                Swal.fire('Deleted!', 'Your item has been deleted.', 'success');
                                window.location.reload()
                            },
                            error: function () {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                                window.location.reload()
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection