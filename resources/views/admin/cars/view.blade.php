@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Car Details</h5>
            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Brand</label>
                        <select name="brand_id" id="brand_list" class="form-control" disabled>
                            <option value="">--- Select Brand ---</option>
                            @foreach($carBrands as $carBrand)
                                <option value="{{ $carBrand->id }}" @selected($carBrand->id == $cars->brand_id)>{{ $carBrand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Model</label>
                        <select name="model_id" id="model_list" class="form-control" disabled>
                            <option value="">--- Select Model ---</option>
                            @foreach($carModels as $carModel)
                                <option value="{{ $carModel->id }}" @selected($carModel->id == $cars->model_id)>{{ $carModel->model_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Year</label>
                        <input disabled type="text" value="{{ $cars->year }}" name="year" class="form-control" placeholder="Enter Year">
                    </div> 
                    <div class="col-sm-6">
                        <label>VIN (Vehicle Identification Number)</label>
                        <input disabled type="text"  value="{{ $cars->VIN }}" name="vin" class="form-control" placeholder="Enter VIN (Exp : PB65A0000)">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Color</label>
                        <input disabled type="text" value="{{ $cars->color }}" name="color" class="form-control" placeholder="Enter Color">
                    </div> 
                    <div class="col-sm-6">
                        <label>Engine Number</label>
                        <input disabled type="text" value="{{ $cars->engine_number }}" name="engine_number" class="form-control" placeholder="Enter Engine Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Chassis Number</label>
                        <input disabled type="text" value="{{ $cars->chassis_number }}" name="chassis_number" class="form-control" placeholder="Enter Chassis Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>Mileage</label>
                        <input disabled type="text" value="{{ $cars->mileage }}" name="mileage" class="form-control" placeholder="Enter Mileage">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Vehicle Type</label>
                        <select name="vehicle_type" class="form-control" disabled>
                            <option value="">--- Select Type ---</option>
                            <option value="hatchback" @selected("hatchback" == $cars->vehicle_type)>HatchBack</option>
                            <option value="sedan" @selected("sedan" == $cars->vehicle_type)>Sedan</option>
                            <option value="suv" @selected("suv" == $cars->vehicle_type)>SUV</option>
                            <option value="other" @selected("other" == $cars->vehicle_type)>Other</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Transmission</label>
                        <select name="transmission" class="form-control" disabled>
                            <option value="">--- Select Type ---</option>
                            <option value="automatic" @selected("automatic" == $cars->transmission)>Automatic</option>
                            <option value="manual" @selected("manual" == $cars->transmission)>Manual</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Fuel Type</label>
                        <select name="fuel_type" class="form-control" disabled>
                            <option value="">--- Select Type ---</option>
                            <option value="petrol" @selected("petrol" == $cars->fuel_type)>Petrol</option>
                            <option value="diesel" @selected("diesel" == $cars->fuel_type)>Diesel</option>
                            <option value="electric" @selected("electric" == $cars->fuel_type)>Electric</option>
                            <option value="hybrid" @selected("hybrid" == $cars->fuel_type)>Hybrid</option>
                            <option value="cng" @selected("cng" == $cars->fuel_type)>CNG</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Doors</label>
                        <input disabled type="text" value="{{ $cars->doors }}" name="doors" class="form-control" placeholder="Enter Number of Doors">
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Condition</label>
                        <select name="condition" class="form-control" disabled>
                            <option value="">--- Select Type ---</option>
                            <option value="average" @selected("average" == $cars->condition)>Average</option>
                            <option value="good" @selected("good" == $cars->condition)>Good</option>
                            <option value="excellent" @selected("excellent" == $cars->condition)>Excellent</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Description</label>
                        <textarea disabled name="description" class="form-control" placeholder="Enter Description">{{ $cars->description }}</textarea>
                    </div> 
                </div>
                <div class="form-group row">
                    @foreach(json_decode($cars->image_urls) as $image_url)
                    <div class="col-md-2 view-images">
                        <a href="{{ asset($image_url) }}"><img src="{{ asset($image_url) }}" width="150px" ></a>
                    </div>
                    @endforeach
                </div>
                <!--button type="submit" class="btn btn-primary primary-btn">Save</button-->
            </form>
        </div>
    </div>
</div>
@endsection