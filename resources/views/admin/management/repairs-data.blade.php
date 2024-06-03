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

        .add-spare-part {
            color: #28183c;
            font-weight: 600;
            border: 1px solid #28183c;
        }

        .add-spare-part:hover {
            color: #28183c;
            font-weight: 600;
            border: 1px solid #28183c;
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
            border: none;
        }

        .actionbutton button:hover,
        .actionbutton button:focus {
            background-color: #46315c;
            border: none;
        }

        .add-invoice {
            background-color: #46315c;
            color: white;
        }

        .add-invoice:hover {
            background-color: #46315c;
            color: white;
        }

        .delete-repair {
            background-color: red;
            color: white;
        }

        .delete-repair:hover {
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
                                <div class="textup">
                                    @if(Auth::user()->role === "mechanic")
                                        <h4 style="text-align:center;">{{ __('My Assigned Repairs') }}</h4>
                                    @elseif(Auth::user()->role === "client")
                                    <h4 style="text-align:center;">{{ __('Scheduled Repairs') }}</h4>
                                    @else
                                        <h4 style="text-align:center;">{{ __('Repairs Management') }}</h4>
                                    @endif
                                    <div class="actionbutton">
                                        <form method="GET" action="{{route('admin.sendAll')}}" >
                                            @if(Auth::user()->role === 'admin' && $completedRepairsCount >= 1)
                                                <button type="submit" class="btn btn-primary textupbutton">
                                                    {{ __('Send Mail To Clients With Repairs Completed') }}  
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top:0;">                              
                                <thead>
                                    <tr role="row">
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('End Date') }}</th>
                                        <th>{{ __('Owner') }}</th>
                                        <th>{{ __('Vehicle registration') }}</th>
                                        @if(Auth::user()->role === 'admin' ||Auth::user()->role === 'mechanic')
                                            <th>{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($repairs as $repair)
                                        <tr data-client-id="{{ $repair->deleteId }}" id="row">
                                            <td>{{ $repair->description }}</td>
                                            <td>
                                                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'mechanic')
                                                    <select class="form-select repair-status" data-repair-id="{{ $repair->id }}">
                                                        <option value="pending" {{ $repair->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }} </option>
                                                        <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }} </option>
                                                        <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }}>{{ __('Completed') }} </option>
                                                    </select>
                                                @else
                                                    <select class="form-select repair-status" data-repair-id="{{ $repair->id }}">
                                                        <option value="pending" {{ $repair->status === 'pending' ? 'selected' : '' }} disabled>{{ __('Pending') }} </option>
                                                        <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }} disabled>{{ __('In Progress') }} </option>
                                                        <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }} disabled>{{ __('Completed') }} </option>
                                                    </select>
                                                @endif
                                            </td>
                                            <td>{{ $repair->startDate }}</td>
                                            <td>{{ $repair->endDate }}</td>
                                            <td>{{ $repair->user->name }}</td>
                                            <td>{{ $repair->vehicle->registration }}</td>
                                            @if (Auth::user()->role !== 'client')
                                                <td>
                                                    @if ($repair->status === 'completed' && Auth::user()->role === "admin")
                                                        <button type="button" class="btn add-invoice" data-repairinvoice-id="{{ $repair->id }}">
                                                            Invoice
                                                        </button>
                                                        <button type="button" class="btn delete-repair" data-repair-id="{{ $repair->id }}">
                                                            Delete
                                                        </button>
                                                    @endif
                                                    @if ($repair->status !== 'completed' && (Auth::user()->role === "admin" || Auth::user()->role === "mechanic"))
                                                        <button type="button" class="btn add-spare-part" data-repair-id="{{ $repair->id }}">
                                                            Add Spare
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @include('admin.layouts.components.repairs.confirm-modal')
                                    @include('admin.layouts.components.invoices.add-modal')
                                    @include('admin.layouts.components.spareParts.add-modal')
                                </tbody>    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;" >
        <div class="text-center p-3" style="background-color:#28183c; display:flex;align-items:center;justify-content:flex-start;">
            <p style="color:white;text-align:center;margin:0 0 0 6rem;">Copyright © 2024 All rights reserved - Zayd Ftouh</p>
        </div>
    </footer>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.querySelectorAll('.repair-status').forEach(function(select) {
        select.addEventListener('change', function() {
            var repairId = this.dataset.repairId;
            var newStatus = this.value;
            axios.post('/repairs/update-status', {
                repair_id: repairId,
                status: newStatus
            });
            location.reload();
        });
    });
</script>
@endsection
