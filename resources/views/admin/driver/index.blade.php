@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Drivers List</h5>
            <a href="{{ route('drivers.create') }}" class="btn btn-primary btn-md primary-btn">Add New Driver</a>
        </div>
        <table id="drivers-list" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Driver Name</th>
                    <th>Vichle Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($drivers as $key => $driver)
                <tr>
                    <td>{{ $key+1 }}</td>    
                    <td>{{ $driver->driver_name }}</td>    
                    <td>{{ $driver->carDetails->VIN }}</td>    
                    <td>
                        <div class="btn-group btn-group-sm">
                                <a href="{{ route('drivers.show', $driver->id) }}"
                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-vehicle-type">
                                    <i class="feather icon-eye m-0"></i>
                                </a>
                                <a href="{{ route('drivers.edit', $driver->id) }}"
                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-vehicle-type">
                                    <i class="feather icon-edit m-0"></i>
                                </a>
                                <button data-source="Car"
                                    data-endpoint="{{ route('drivers.destroy', $driver->id) }}"
                                    class="delete-btn primary-btn btn btn-danger waves-effect waves-light">
                                    <i class="feather icon-trash m-0"></i>
                                </button>
                        </div>
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <x-include-plugins dataTable></x-include-plugins>
    <script>
        $(function() {
            $('#drivers-list').DataTable({
                searching: true
            });
        })
    </script>
@endsection