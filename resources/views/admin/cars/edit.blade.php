@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">View Car Details</h5>
            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form id="drivers" action="{{ route('cars.update',$newDriver->registration_number) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')      
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Driver ID</label>
                        <input  type="text"  value="{{ $newDriver->driver_id }}" name="driver_id" class="form-control" >
                    </div>
                    <div class="col-sm-6">
                        <label>Registration Number</label>
                        <input  type="text" value="{{ $newDriver->registration_number }}" name="registration_number" class="form-control" >
                    </div> 


                    <div class="col-sm-6">
                        <label>Car Brand</label>
                        <select  name="brand_id" id="brand_list" class="form-control">
                            @foreach($carBrands as $carBrand)
                                <option value="{{ $carBrand->id}}" @selected($newDriver->brand_id == $carBrand->id)>{{ $carBrand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Car Model</label>
                        <select name="model_id" id="model_list" class="form-control">
                            @foreach($carModels as $carModel)
                                <option value="{{ $carModel->id}}" @selected($newDriver->model_id == $carModel->id)>{{ $carModel->model_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label>Chassis Number</label>
                        <input  type="text" value="{{ $newDriver->chassis_number }}" name="chassis_number" class="form-control" >
                    </div>
                    <div class="col-sm-6">
                        <label>Engine Number</label>
                        <input  type="text" value="{{ $newDriver->engine_number }}" name="engine_number" class="form-control" >
                    </div> 

                    <div class="col-sm-6">
                        <label>Locations</label>
                        <textarea  type="text" value="{{ $newDriver->locations }}" name="locations" class="form-control">{{ $newDriver->locations }}</textarea>
                    </div>

                    <div class="form-group  mt-5 row">
                        <div class="col-sm-2">
                            <label>Car RC</label>
                            <a target="_blank" href="{{ asset($newDriver->car_rc) }}"><img class="dr-document" src="{{ asset($newDriver->car_rc) }}"></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label>Add new car images</label>
                        <input type="file" name="car_images[]" id="images" multiple>
                        <div id="image_preview_new"></div>
                    </div>
                    <div class="form-group mt-5 row">

                        @foreach(json_decode($newDriver->car_images) as $key=> $carImages)
                            <div class="col-sm-2" data-id="{{ $carImages }}">
                                <a target="_blank" href="{{ asset($carImages) }}"><img class="dr-document" src="{{ asset($carImages) }}"></a>
                                <i class="fa fa-trash" id="delete-img" data-image-path="{{ $carImages }}" data-car-id="{{ $newDriver->registration_number }}"></i>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary primary-btn">Save</button>
            </form>
        </div>
    </div>
</div>
<x-include-plugins multipleImage></x-include-plugins>
<x-include-plugins imagePreview></x-include-plugins>
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
});
$(function() {
    $('form').validate({
        rules: {
            driver_name: "required",
            license_number: "required",
            contact_information: "required",
            vehicle_number: "required",
            driver_status: "required",
            location: "required",
        },
        messages: {
            driver_name: "Please enter driver name",
            license_number: "Please enter license number",
            contact_information: "Please enter contact infomation",
            vehicle_number: "Please select vehicle number",
            driver_status: "Please select driver status",
            location: "Please enter location",
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

$('i#delete-img').click(function(){
    alert();
    var image_path = $(this).data('image-path');
    var car_id = $(this).data('car-id');

        $.ajax({
            url: "{{ url('delete-car-image') }}",
            type: "POST",
            data: {
                image_path: image_path,
                car_id: car_id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                if(result.success){
                    $('[data-id="'+image_path+'"]').hide();
                }
            }
        });
});


</script>
@endsection