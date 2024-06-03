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
        }
        #importForm {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Adjust spacing between elements */
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
        }
        .edit-client:hover {
            background-color: #46315c;
            color: white;
        }
        .delete-spare {
            background-color: red;
            color: white;
        }
        .delete-spare:hover {
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
                            <div class="add-new">
                                <div class="textup">
                                    <h4>{{ __('Spare Part Management') }}</h4>
                                    <p class="card-title-desc"></p>
                                </div>
                            </div>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0;">
                                <thead>
                                    <tr role="row">
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Part Name') }}</th>
                                        <th>{{ __('Part Reference') }}</th>
                                        <th>{{ __('Supplier') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        @if (Auth::user()->role === "admin")
                                        <th>{{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($spares as $spare)
                                    <tr data-spare-id="{{ $spare->deleteId }}" id="row">
                                        <td>
                                            @foreach ($spare->repairs as $repair)
                                            {{ $repair->description }}
                                            @endforeach
                                        </td>
                                        <td>{{ $spare->partName }}</td>
                                        <td>{{ $spare->partReference }}</td>
                                        <td>{{ $spare->supplier }}</td>
                                        <td>{{ $spare->price }}</td>
                                        @if (Auth::user()->role !== 'client')
                                        <td>
                                            @if (Auth::user()->role === "admin")
                                            <button type="button" class="btn delete-spare" data-spare-id="{{ $spare->id }}">
                                                Delete
                                            </button>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    {{-- @include('admin.layouts.components.users.edit-modal')
                                    @include('admin.layouts.components.users.add-modal')--}}
                                    @include('admin.layouts.components.spareParts.confirm-modal')
                                    {{-- @include('admin.layouts.components.invoices.show-modal') --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-body-tertiary text-center mt-30" style="bottom: 0; position: fixed; left: 150px; right: 0;">
        <div class="text-center p-3" style="background-color: #28183c; display: flex; align-items: center; justify-content: flex-start;">
            <p style="color: white; text-align: center; margin: 0 0 0 6rem;">Copyright © 2024 All rights reserved -
                Zayd Ftouh</p>
        </div>
    </footer>
</div>
@endsection
