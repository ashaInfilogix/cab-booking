@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Car Details Edit</h5>
            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form action="{{ route('cars.update',$cars->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Brand</label>
                        <select name="brand_id" id="brand_list" class="form-control" >
                            <option value="">--- Select Brand ---</option>
                            @foreach($carBrands as $carBrand)
                                <option value="{{ $carBrand->id }}" @selected($carBrand->id == $cars->brand_id)>{{ $carBrand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Model</label>
                        <select name="model_id" id="model_list" class="form-control" >
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
                        <input  type="text" value="{{ $cars->year }}" name="year" class="form-control" placeholder="Enter Year">
                    </div> 
                    <div class="col-sm-6">
                        <label>VIN (Vehicle Identification Number)</label>
                        <input  type="text"  value="{{ $cars->VIN }}" name="vin" class="form-control" placeholder="Enter VIN (Exp : PB65A0000)">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Color</label>
                        <input  type="text" value="{{ $cars->color }}" name="color" class="form-control" placeholder="Enter Color">
                    </div> 
                    <div class="col-sm-6">
                        <label>Engine Number</label>
                        <input  type="text" value="{{ $cars->engine_number }}" name="engine_number" class="form-control" placeholder="Enter Engine Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Chassis Number</label>
                        <input  type="text" value="{{ $cars->chassis_number }}" name="chassis_number" class="form-control" placeholder="Enter Chassis Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>Mileage</label>
                        <input  type="text" value="{{ $cars->mileage }}" name="mileage" class="form-control" placeholder="Enter Mileage">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Vehicle Type</label>
                        <select name="vehicle_type" class="form-control" >
                            <option value="">--- Select Type ---</option>
                            <option value="hatchback" @selected("hatchback" == $cars->vehicle_type)>HatchBack</option>
                            <option value="sedan" @selected("sedan" == $cars->vehicle_type)>Sedan</option>
                            <option value="suv" @selected("suv" == $cars->vehicle_type)>SUV</option>
                            <option value="other" @selected("other" == $cars->vehicle_type)>Other</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Transmission</label>
                        <select name="transmission" class="form-control" >
                            <option value="">--- Select Type ---</option>
                            <option value="automatic" @selected("automatic" == $cars->transmission)>Automatic</option>
                            <option value="manual" @selected("manual" == $cars->transmission)>Manual</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Fuel Type</label>
                        <select name="fuel_type" class="form-control" >
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
                        <input  type="text" value="{{ $cars->doors }}" name="doors" class="form-control" placeholder="Enter Number of Doors">
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Condition</label>
                        <select name="condition" class="form-control" >
                            <option value="">--- Select Type ---</option>
                            <option value="average" @selected("average" == $cars->condition)>Average</option>
                            <option value="good" @selected("good" == $cars->condition)>Good</option>
                            <option value="excellent" @selected("excellent" == $cars->condition)>Excellent</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Description</label>
                        <textarea  name="description" class="form-control" placeholder="Enter Description">{{ $cars->description }}</textarea>
                    </div> 
                </div>
                <div class="form-group">
                    <div class="col-md-12 form-group">
                        <label for="image" class>Car Images</label>
                        <input type="file" name="images[]" id="images" multiple class="form-control" >
                        <div id="image_preview_new"></div>
                    </div>
                </div>
                <div class="form-group row">
                    @foreach(json_decode($cars->image_urls) as $image_url)
                    <div class="col-md-2 view-images" id="{{ $image_url }}">
                        <div class="image-container">
                            <a href="{{ asset($image_url) }}" class="image-link">
                                <img src="{{ asset($image_url) }}" class="image" width="150px">
                            </a>
                            <div class="overlay-icons">
                                <a href="#" class="delete-icon delete-image" data-image-path="{{ $image_url }}" data-car-id="{{ $cars->id }}"><i class="fas fa-trash-alt"></i></a>
                                <a href="{{ asset($image_url) }}" class="view-icon"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary primary-btn">Save</button>
            </form>
        </div>
    </div>
</div>
<x-include-plugins multipleImage></x-include-plugins>
<script>
$(function() {
    $('#brand_list').on('change', function() {
        var model_id = this.value;
        $("#model_list").html('');
        $.ajax({
            url: "{{ url('get-car-brands') }}",
            type: "POST",
            data: {
                model_id: model_id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#model_list').html(result.options);
            }
        });
    });
    $('.delete-image').on('click', function(e) {
        e.preventDefault();
        var carId = $(this).attr('data-car-id');
        var imagePath = $(this).attr('data-image-path');
        swal({
            title: "Are you sure?",
            text: `You really want to remove this Image?`,
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "{{ url('delete-car-image') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        carId :carId,
                        imagePath : imagePath
                    },
                    success: function(response) {
                        if(response.success){
                            swal({
                                title: "Success!",
                                text: 'Image Deleted',
                                type: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }) 
                            $('[id="'+imagePath+'"]').hide();
                        }
                    }
                })
            }
        });


    });

});
$(function() {
    $('form').validate({
        rules: {
            year: "required"
        },
        messages: {
            year: "Please enter year name"
        },
        errorClass: "text-danger f-12",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("form-control-danger");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass("form-control-danger");
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
})
</script>
@endsection