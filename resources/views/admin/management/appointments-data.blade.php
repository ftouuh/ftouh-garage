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
        .add-appointment,
        .add-appointment:hover {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
            background-color: #46315c;
        }
        .textup {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100px;
        }
        .delete-appointment,
        .delete-appointment:hover {
            background-color: red;
            color: white;
        }
        .textupbutton {
            background-color: #46315c;
            border: none;
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
                                @if(Auth::user()->role === 'admin')
                                    <h4>{{ __('Appointment List') }}</h4>
                                @else
                                    <h4>{{ __('Your Appointment') }}</h4>
                                @endif
                                <button class="btn-primary add-appointment textupbutton">{{ __('Add New Appointment') }}</button>
                            </div>
                        </div>  

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top: 0;">
                            <thead>
                                <tr role="row">
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('User Name') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Time') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr data-invoice-id="{{ $appointment->deleteId }}" id="row">
                                        <td>{{ $appointment->description }}</td>
                                        <td>{{ $appointment->user->name }}</td>
                                        <td>{{ $appointment->appointment_date }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                        <td>
                                            @if(Auth::user()->role === 'admin')
                                                <select class="form-select update-appointment-status" data-appointment-id="{{ $appointment->id }}">
                                                    <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                                    <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                                                    <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                                    <option value="canceled" {{ $appointment->status === 'canceled' ? 'selected' : '' }}>{{ __('Canceled') }}</option>
                                                </select>
                                            @else
                                                {{ $appointment->status }}
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn delete-appointment" data-appointment-id="{{ $appointment->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                @include('admin.layouts.components.appointment.confirm-modal') 
                                @include('admin.layouts.components.appointment.add-modal')
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                            <ul class="pagination pagination-rounded">
                                <li class="paginate_button page-item previous disabled" id="datatable_previous">
                                    <a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                </li>
                                <li class="paginate_button page-item next disabled" id="datatable_next">
                                    <a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->

    <footer class="bg-body-tertiary text-center mt-30" style="bottom: 0; position: fixed; left: 150px; right: 0;">
        <div class="text-center p-3" style="background-color: #28183c; display: flex; align-items: center; justify-content: flex-start;">
            <p style="color: white; text-align: center; margin: 0 0 0 6rem;">Copyright © 2024 All rights reserved - Zayd Ftouh</p>
        </div>
    </footer>
</div>
@endsection
