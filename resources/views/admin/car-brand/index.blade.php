@extends('layouts.admin.admin-layout')

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <div class="row">
                        <div class="col-sm-12">
                            @if (session('success'))
                                <x-alert message="{{ session('success') }}"></x-alert>
                            @endif
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Car Brands</h5>
                                    <a href="{{ route('car-brand.create') }}" class="btn btn-primary btn-md primary-btn">Add
                                        Car Brand</a>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="car-brands-list" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Brand Name</th>
                                                    <th>Brand Logo</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($carBrands as $key => $carBrand)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>    
                                                    <td>{{ $carBrand->brand_name }}</td>    
                                                    <td><img width="50px" height="50px" src="{{ asset($carBrand->brand_image) }}"></td>    
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                                <a href="{{ route('car-brand.edit', $carBrand->id) }}"
                                                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-vehicle-type">
                                                                    <i class="feather icon-edit m-0"></i>
                                                                </a>
                                                                <button data-source="brand"
                                                                    data-endpoint="{{ route('car-brand.destroy', $carBrand->id) }}"
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
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-include-plugins dataTable></x-include-plugins>

    <script>
        $(function() {
            $('#car-brands-list').DataTable();
        })
    </script>
@endsection