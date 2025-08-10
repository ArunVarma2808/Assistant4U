@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Regions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Regions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-create">
                    <i class="m-0 bi bi-plus"></i> Add Region
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="region-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-region" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Region</th>
                            <th>Province</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($regions as $region)
                            <tr>
                                <td>{{ $region->name }}</td>
                                <td>{{ $region->province->name }}</td>
                                <td>
                                    <form action="{{ route('regions.delete', ['region' => $region]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm btn-edit" data-region-id="{{ $region->id }}">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-sm btn-edit">
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
            $('#tbl-region').DataTable();

             $('.btn-create').click(function (e) {
                e.preventDefault();
                const doctor = $(this).data('doctor');
                $.ajax({
                    type: "GET",
                    url: `regions/create`,
                    success: function (response) {
                        $('#region-modal .modal-dialog').html(response);
                        $('#region-modal').modal('show');
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.btn-edit').click(function (e) {
                e.preventDefault();
                const region = $(this).data('region-id');
                $.ajax({
                    type: "GET",
                    url: `regions/${region}/edit`,
                    success: function (response) {
                        $('#region-modal .modal-dialog').html(response);
                        $('#region-modal').modal('show');
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