@extends('layouts.app')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Working Staffs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Working Staffs</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="staff-modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tbl-province" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Has active subscription?</th>
                            <th>Is Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $staff)
                            <tr>
                                <td>{{ $staff->name }}</td>
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->phone }}</td>
                                <td>
                                    @if ($staff->is_subscribed)
                                        <span class="text-default"> Yes (expiry on {{ \Carbon\Carbon::parse($staff->subscription_expires_at)->format('Y-m-d') }})</span>
                                    @else
                                        <span class="text-danger"> No (expired on {{ \Carbon\Carbon::parse($staff->subscription_expires_at)->format('Y-m-d') }})</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input tg-users-status"
                                            data-user-id="{{ $staff->id }}" {{ $staff->is_active ? 'checked' : '' }}>
                                    </div>
                                    {{-- <form class="dlt-form"
                                        action="{{ route('provinces.delete', ['province' => $province]) }}" method="post">
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
                                    </form> --}}
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

            $('.tg-users-status').change(function (e) {
                e.preventDefault();
                const is_active = $(this).is(':checked');
                const user_id = $(this).data('user-id');
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        is_active: is_active,
                        user_id: user_id,
                    },
                    url: `update-user-status`,
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response?.status);
                        if (response?.status == "success") {
                            Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                size: 'mini',
                                rounded: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-check-circle',
                                msg: response?.message
                            });
                        } else {
                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-x-circle',
                                msg: response?.message
                            });
                        }
                    },
                    error: function (xhr) {
                        alert("something went wrong.");
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.btn-create').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: `provinces/create`,
                    success: function (response) {
                        $('#staff-modal .modal-dialog').html(response);
                        $('#staff-modal').modal('show');
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
                        $('#staff-modal .modal-dialog').html(response);
                        $('#staff-modal').modal('show');
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