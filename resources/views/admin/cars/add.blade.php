@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Add Car</h5>
            <a href="{{ route('cars.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Brand</label>
                        <select name="brand_id" id="brand_list" class="form-control">
                            <option value="">--- Select Brand ---</option>
                            @foreach($carBrands as $carBrand)
                                <option value="{{ $carBrand->id }}">{{ $carBrand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Model</label>
                        <select name="model_id" id="model_list" class="form-control">
                            <option value="">--- Select Model ---</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Year</label>
                        <input type="text" name="year" class="form-control" placeholder="Enter Year">
                    </div> 
                    <div class="col-sm-6">
                        <label>VIN (Vehicle Identification Number)</label>
                        <input type="text"  name="vin" class="form-control" placeholder="Enter VIN (Exp : PB65A0000)">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Color</label>
                        <input type="text" name="color" class="form-control" placeholder="Enter Color">
                    </div> 
                    <div class="col-sm-6">
                        <label>Engine Number</label>
                        <input type="text"  name="engine_number" class="form-control" placeholder="Enter Engine Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Chassis Number</label>
                        <input type="text" name="chassis_number" class="form-control" placeholder="Enter Chassis Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>Mileage</label>
                        <input type="text"  name="mileage" class="form-control" placeholder="Enter Mileage">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Vehicle Type</label>
                        <select name="vehicle_type" class="form-control">
                            <option value="">--- Select Type ---</option>
                            <option value="hatchback">HatchBack</option>
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="other">Other</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Transmission</label>
                        <select name="transmission" class="form-control">
                            <option value="">--- Select Type ---</option>
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                        </select>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Fuel Type</label>
                        <select name="fuel_type" class="form-control">
                            <option value="">--- Select Type ---</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="cng">CNG</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Doors</label>
                        <input type="text" name="doors" class="form-control" placeholder="Enter Number of Doors">
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Condition</label>
                        <select name="condition" class="form-control">
                            <option value="">--- Select Type ---</option>
                            <option value="average">Average</option>
                            <option value="good">Good</option>
                            <option value="excellent">Excellent</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                    </div> 
                </div>
                <div class="form-group">
                    <div class="col-md-12 form-group">
                        <label for="image" class>Car Images</label>
                        <input type="file" name="images[]" id="images" multiple class="form-control" required>
                        <div id="image_preview_new"></div>
                    </div>
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