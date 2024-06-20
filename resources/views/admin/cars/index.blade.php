@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Models List</h5>
            <a href="{{ route('cars.create') }}" class="btn btn-primary btn-md primary-btn">Add Car</a>
        </div>
        <table id="cars-list" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Model</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $key => $car)
                <tr>
                    <td>{{ $key+1 }}</td>    
                    <td>{{ $car->models->model_name }}</td>    
                    <td>{{ $car->brands->brand_name }}</td>    
                    <td>
                        <div class="btn-group btn-group-sm">
                                <a href="{{ route('cars.show', $car->id) }}"
                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-vehicle-type">
                                    <i class="feather icon-eye m-0"></i>
                                </a>
                                <a href="{{ route('cars.edit', $car->id) }}"
                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-vehicle-type">
                                    <i class="feather icon-edit m-0"></i>
                                </a>
                                <button data-source="Car"
                                    data-endpoint="{{ route('cars.destroy', $car->id) }}"
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
            $('#cars-list').DataTable({
                searching: true
            });
        })
    </script>
@endsection




