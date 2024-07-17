@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Add Models</h5>
            <a href="{{ route('car-model.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form action="{{ route('car-model.store')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" name="model_name" class="form-control" placeholder="Enter Model Name">
                    </div>
                    <div class="col-sm-6">
                        <select name="brand_id" class="form-control">
                            <option value="">Select Brand</option>
                            @foreach($carBrands as $carBrand)
                                <option value="{{ $carBrand->id }}">{{ $carBrand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary primary-btn">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection