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

        .add-client,
        .import-clients {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
            width: 200px;
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
            color: white;
            border: none;
            padding: 8px 19px;
            border-radius: 5px;
            cursor: pointer;
        }

        .actionbutton button:hover {
            background-color: #46315c;
            color: white;
        }

        .edit-client,
        .print-invoice {
            background-color: #46315c;
            color: white;
            border: none;
            padding: 8px 19px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-client:hover,
        .print-invoice:hover {
            background-color: #46315c;
            color: white;
        }

        .delete-invoice {
            background-color: red;
            color: white;
        }

        .delete-invoice:hover {
            background-color: red;
            color: white;
        }

        .table-bordered tr,
        .table-bordered th,
        .table-bordered td {
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
                        <div class="add-new">
                            <div class="textup">
                                <h4>{{ __('Invoices Management') }}</h4>
                                <p class="card-title-desc"></p>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0;">
                            <thead>
                                <tr role="row">
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Mechanic Name') }}</th>
                                    <th>{{ __('Make') }}</th>
                                    <th>{{ __('Registration') }}</th>
                                    <th>{{ __('Additional Charges') }}</th>
                                    <th>{{ __('TotalAmount') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                <tr data-invoice-id="{{ $invoice->deleteId }}" id="row">
                                    <td>{{ $invoice->repair->user->name }}</td>
                                    <td>{{ $invoice->repair->mechanic->name }}</td>
                                    <td>{{ $invoice->repair->vehicle->make }}</td>
                                    <td>{{ $invoice->repair->vehicle->registration }}</td>
                                    <td>{{ $invoice->additionalCharges }}</td>
                                    <td>{{ $invoice->totalAmount }}</td>
                                    <td>
                                        <div style="display:flex; gap:.7rem;">
                                        <form action="{{ route('pdf', ['id' => $invoice->id]) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn print-invoice">Print</button>
                                        </form>
                                        <button type="button" class="btn delete-invoice"
                                            data-invoice-id="{{ $invoice->id }}">Delete</button>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @include('admin.layouts.components.invoices.confirm-modal')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-body-tertiary text-center mt-30" style="bottom: 0; position: fixed; left: 150px; right: 0;">
        <div class="text-center p-3"
            style="background-color: #28183c; display: flex; align-items: center; justify-content: flex-start;">
            <p style="color: white; text-align: center; margin: 0 0 0 6rem;">Copyright © 2024 All rights reserved -
                Zayd Ftouh</p>
        </div>
    </footer>
</div>
@endsection
