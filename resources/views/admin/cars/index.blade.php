@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Drivers List</h5>
            <a href="{{ route('cars.create') }}" class="btn btn-primary btn-md primary-btn">Add New Car</a>
        </div>
        <table id="new-drivers-list" class="table table-striped table-bordered nowrap">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Driver Name</th>
                    <th>Driver Profile</th>
                    <th>Vichle Number</th>
                    <th>Date & Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">   
                @foreach($carsList as $newDriver)
                    <tr>
                        <td>{{ $newDriver->driver_id }}</td>    
                        <td>{{ $newDriver->name.' '.$newDriver->last_name }}</td>    
                        <td><img src="{{ asset($newDriver->profile_pic) }}" width="50px" height="50px"></td>    
                        <td>{{ $newDriver->carDetails->registration_number }}</td>
                        <td>{{ $newDriver->created_at }}</td>
            
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('cars.edit',$newDriver->carDetails->registration_number) }}"
                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-vehicle-type">
                                    <i class="feather icon-eye m-0"></i> View Details
                                </a>
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
            $('#new-drivers-list').DataTable({
                searching: true
            });
        })
    </script>
@endsection