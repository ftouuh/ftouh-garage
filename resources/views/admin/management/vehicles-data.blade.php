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
            gap: 10px;
        }

        .add-vehicle {
            border: 0;
            border-radius: 5px;
            padding: 8px 19px;
            width: 200px;
            background-color: #46315c;
            color: white;
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

        .edit-vehicle {
            background-color: #46315c;
            color: white;
        }

        .show-pics {
            background-color: #46315c;
            color: white;
        }

        .add-repair {
            color: #28183c;
            font-weight: 600;
            border: 1px solid #28183c;
        }

        .edit-vehicle:hover {
            background-color: #46315c;
            color: white;
        }

        .delete-vehicle {
            background-color: red;
            color: white;
        }

        .delete-vehicle:hover {
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-new">
                                <h4>{{ __('Vehicles List') }}</h4>
                                <div>
                                    <button class="add-vehicle">{{ __('Add New Vehicle') }}</button>
                                </div>
                                <p class="card-title-desc"></p>
                            </div>
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Make') }}</th>
                                        <th>{{ __('Model') }}</th>
                                        <th>{{ __('Fuel Type') }}</th>
                                        <th>{{ __('Registration') }}</th>
                                        <th>{{ __('Owner') }}</th>
                                        <th>{{ __('Photos') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($vehicles)
                                    @foreach ($vehicles as $vehicle)
                                    <tr data-vehicle-id="{{ $vehicle->vehicleId }}" id="row">
                                        <td>{{ $vehicle->make }}</td>
                                        <td>{{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->fuelType }}</td>
                                        <td>{{ $vehicle->registration }}</td>
                                        <td>{{ $vehicle->user->name }}</td>
                                        <td>
                                            <button type="button" class="btn show-pics"
                                                data-vehicle-id="{{ $vehicle->id }}">
                                                {{ __('Show Pictures') }}
                                            </button>
                                        </td>
                                        <td>
                                            <!-- Display edit and delete buttons for admin -->
                                            @if(Auth::user()->role === 'admin')
                                            <button type="button" class="btn edit-vehicle"
                                                data-vehicles-id="{{ $vehicle->id }}"
                                                data-vehicle-make="{{ $vehicle->make }}"
                                                data-vehicle-model="{{ $vehicle->model }}"
                                                data-vehicle-fueltype="{{ $vehicle->fuelType }}"
                                                data-vehicle-registration="{{ $vehicle->registration }}"
                                                data-vehicle-photos="{{ $vehicle->photos }}"
                                                data-vehicle-userid="{{ $vehicle->user_id }}">
                                                {{ __('Edit') }}
                                            </button>
                                            <button type="button" class="btn delete-vehicle"
                                                data-vehicle-id="{{ $vehicle->id }}">
                                                {{ __('Delete') }}
                                            </button>
                                            <button type="button" class="btn add-repair"
                                                data-vehicle-id="{{ $vehicle->id }}"
                                                data-vehicle-iduser="{{ $vehicle->user_id }}">
                                                {{ __('Repair') }}
                                            </button>
                                            <!-- Display edit and delete buttons for vehicle owner -->
                                            @elseif(Auth::id() === $vehicle->user_id)
                                            <button type="button" class="btn edit-vehicle"
                                                data-vehicles-id="{{ $vehicle->id }}"
                                                data-vehicle-make="{{ $vehicle->make }}"
                                                data-vehicle-model="{{ $vehicle->model }}"
                                                data-vehicle-fueltype="{{ $vehicle->fuelType }}"
                                                data-vehicle-registration="{{ $vehicle->registration }}"
                                                data-vehicle-photos="{{ $vehicle->photos }}"
                                                data-vehicle-userid="{{ $vehicle->user_id }}">
                                                {{ __('Edit') }}
                                            </button>
                                            <button type="button" class="btn delete-vehicle"
                                                data-vehicle-id="{{ $vehicle->id }}">
                                                {{ __('Delete') }}
                                            </button>
                                            <button type="button" class="btn add-repair"
                                                data-vehicle-id="{{ $vehicle->id }}"
                                                data-vehicle-iduser="{{ $vehicle->user_id }}">
                                                {{ __('Repair') }}
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                @include('admin.layouts.components.vehicles.edit-modal')
                                @include('admin.layouts.components.vehicles.add-modal')
                                @include('admin.layouts.components.repairs.add-modal')
                                @include('admin.layouts.components.vehicles.confirm-modal')
                                @include('admin.layouts.components.vehicles.show-pics')
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-body-tertiary text-center mt-30"
        style="bottom: 0; position: fixed; left: 150px; right: 0;">

        <div class="text-center p-3"
            style="background-color: #28183c; display: flex; align-items: center; justify-content: flex-start;">

            <p style="color: white; text-align: center; margin: 0 0 0 6rem;">
                {{ __('Copyright © 2024 All rights reserved - Zayd Ftouh') }}
            </p>
        </div>

    </footer>
</div>
@endsection
