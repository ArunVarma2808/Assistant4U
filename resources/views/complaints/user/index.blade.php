@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Complaints</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Complaints</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-create">
                    <i class="m-0 bi bi-plus"></i> Add Complaint
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="complaint-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-province" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Complaint Message</th>
                            <th>Reported On</th>
                            <th>Reply</th>
                            <th>Replied On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complaints as $complaint)
                            <tr>
                                <td>
                                    <p>{{ $complaint->message }}</p>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($complaint->messaged_on)->format('Y-m-d, H:i') }}
                                </td>
                                <td>
                                    @if(!empty($complaint->reply))
                                        <p>{{ $complaint->reply }}</p>
                                    @else
                                        <p class="text-center">-- Haven't responded yet --</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($complaint->replied_on)
                                    {{ \Carbon\Carbon::parse($complaint->replied_on)->format('Y-m-d, H:i') }}
                                    @endif
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
                    url: `complaints/create`,
                    success: function (response) {
                        $('#complaint-modal .modal-dialog').html(response);
                        $('#complaint-modal').modal('show');
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection