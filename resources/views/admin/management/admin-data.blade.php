@extends('admin.layouts.home')
@section('content')
<div class="main-content">

    <style>
        .add-new {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            height: fit-content;
        }

        .add-client, .import-clients {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
        }

        #importForm {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .actionbutton {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 20px;
        }

        .actionbutton button {
            background-color: #46315c;
        }

        .actionbutton button:hover {
            background-color: #46315c;
        }

        .edit-client {
            background-color: #46315c;
            color: white;
            border: none;
        }

        .edit-client:hover {
            background-color: #46315c;
            color: white;
        }

        .delete-client {
            background-color: red;
            color: white;
        }

        .delete-client:hover {
            background-color: red;
            color: white;
        }

        .table-bordered tr, .table-bordered th, .table-bordered td {
            border-color: #46315c !important;
        }

        table {
            border: none;
        }

        thead {
            background-color: #46315c;
            color: white;
            border: 1px solid #46315c;
        }

        th {
            color: white;
            border: none;
        }

        .even {
            background-color: #f8f9fa;
        }

        td {
            background-color: #b1a2b9;
        }

        #file {
            padding: 5px;
            border: 1px solid #ccc;
        }

        #importButton {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="textup">
                            <h4>{{ __('Admins List') }}</h4>
                            <p class="card-title-desc"></p>
                        </div>

                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Start Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($admins as $client)
                                <tr data-client-id="{{$client->id}}">
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>{{ $client->phoneNumber }}</td>
                                    <td>{{ $client->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit-client"
                                                data-client-id="{{ $client->id }}"
                                                data-client-name="{{ $client->name }}"
                                                data-client-email="{{ $client->email }}"
                                                data-client-address="{{ $client->address }}"
                                                data-client-phone="{{ $client->phoneNumber }}">
                                            {{ __('Edit') }}
                                        </button>
                                    </td>
                                </tr>

                                @include('admin.layouts.components.users.edit-modal')

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div> <!-- End Page-content -->

    <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;">
        <div class="text-center p-3" style="background-color: #28183c; display: flex; align-items: center; justify-content: flex-start;">
            <p style="color: white; text-align: center; margin: 0 0 0 6rem;">Copyright © 2024 All rights reserved - Zayd Ftouh</p>
        </div>
    </footer>
</div>

<!-- Modal for editing admin -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdminModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAdminForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitEditAdminForm">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.edit-client').click(function() {
            var clientId = $(this).data('client-id');
            var clientName = $(this).data('client-name');
            var clientEmail = $(this).data('client-email');
            var clientAddress = $(this).data('client-address');
            var clientPhone = $(this).data('client-phone');

            $('#editAdminModal #name').val(clientName);
            $('#editAdminModal #email').val(clientEmail);
            $('#editAdminModal #address').val(clientAddress);
            $('#editAdminModal #phoneNumber').val(clientPhone);
            $('#editAdminModal').modal('show');
        });

        $('#submitEditAdminForm').click(function() {
            $('#editAdminForm').submit();
        });
    });
</script>
@endpush
