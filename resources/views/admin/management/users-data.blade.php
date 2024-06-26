@extends('admin.layouts.home')
@section('content')
<div class="main-content">
    <style>
        .add-new {
            display: flex;
            width: 100%;
            flex-direction: column;
            align-items: center;
            height: fit-content;
        }
        .add-client, .import-clients {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
            width: 200px;
            color:white;
            background-color: #46315c;
        }
        #importForm {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .export{
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
            width: 200px;
            color:white;
            background-color: #46315c;
        }
        .actionbutton {
            display: flex;
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
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="textup" style="text-align:center;">
                                <h4>{{ __('Clients List') }}</h4>
                                <form action="{{route('export.clients')}}" method="get">
                                    <button type="submit" class="export">Export to excel file</button>
                                </form>
                            </div>
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0; border-radius: 10px;">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone Number') }}</th>
                                            <th>{{ __('Start Date') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr data-client-id="{{ $client->deleteId }}" id="row">
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>{{ $client->phoneNumber }}</td>
                                                <td>{{ $client->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn edit-client" data-client-id="{{ $client->id }}" data-client-name="{{ $client->name }}" data-client-email="{{ $client->email }}" data-client-address="{{ $client->address }}" data-client-phone="{{ $client->phoneNumber }}">Edit</button>
                                                    @if (Auth::user()->role === "admin")
                                                        <button type="button" class="btn delete-client danger" data-client-id="{{ $client->id }}">Delete</button>
                                                    @endif    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
    <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;">
        <div class="text-center p-3" style="background-color:#28183c; display:flex;align-items:center;justify-content:flex-start;">
            <p style="color:white;text-align:center;margin:0 0 0 6rem;">Copyright © 2024 All rights reserved - Zayd Ftouh</p>
        </div>
    </footer>
</div>
@include('admin.layouts.components.users.edit-modal')
@include('admin.layouts.components.users.add-modal')
@include('admin.layouts.components.users.import-modal')
@include('admin.layouts.components.users.confirm-modal')
@endsection
