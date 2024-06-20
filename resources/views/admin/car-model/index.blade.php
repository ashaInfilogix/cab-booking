@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Models List</h5>
            <a href="{{ route('car-model.create') }}" class="btn btn-primary btn-md primary-btn">Add Model</a>
        </div>
        <table id="car-model-list" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Model</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
            @foreach ($carModels as $key => $carModel)
                <tr>
                    <td>{{ $key+1 }}</td>    
                    <td>{{ $carModel->model_name }}</td>    
                    <td>{{ $carModel->brands->brand_name }}</td>    
                    <td>
                        <div class="btn-group btn-group-sm">
                                <a href="{{ route('car-model.edit', $carModel->id) }}"
                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-vehicle-type">
                                    <i class="feather icon-edit m-0"></i>
                                </a>
                                <button data-source="Model"
                                    data-endpoint="{{ route('car-model.destroy', $carModel->id) }}"
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
            $('#car-model-list').DataTable();
        })
    </script>
@endsection




