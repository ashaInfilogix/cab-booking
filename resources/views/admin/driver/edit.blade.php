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
            <h5 class="m-0">View Driver Details</h5>
            <a href="{{ route('new.driver') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form id="drivers" action="{{ route('drivers.update',$newDriver->driver_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group text-align-left position-relative">
                    <img id="profilePic" height="150px" src="{{ asset($newDriver->profile_pic)}}" class="profile-pic" alt="Profile Picture">
                    <div class="edit-button edit">
                        <i class="fa fa-pencil-alt" id="change_pic"></i>
                    </div>
                    <input type="file" value="{{ $newDriver->profile_pic }}" name="profile_pic" style="display:none;" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Driver Name</label>
                        <input  type="text" value="{{ $newDriver->name.' '.$newDriver->last_name }}" name="full_name" class="form-control">
                    </div> 
                    <div class="col-sm-6">
                        <label>License Number</label>
                        <input  type="text"  value="{{ $newDriver->license_number }}" name="license_number" class="form-control" placeholder="Enter License Number">
                    </div>

                    <div class="col-sm-6">
                        <label>Driver Status</label>
                        <select name="driver_status" class="form-control">
                            <option value="">--- Select Driver Status ---</option>
                            <option value="not_approved" @selected('not_approved' == $newDriver->status)>Not Approved</option>
                            <option value="active" @selected('active' == $newDriver->status)>Approved</option>
                            <option value="deactive" @selected('deactive' == $newDriver->status)>Deactivate</option>
                            <option value="blocked" @selected('blocked' == $newDriver->status)>Blocked</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Contact Number</label>
                        <input  type="number" value="{{ $newDriver->contact_number }}" name="contact_number" class="form-control" placeholder="Enter Contact Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>DOB</label>
                        <input  type="date" id="dob" value="{{ $newDriver->dob }}" name="dob" class="form-control" placeholder="Enter DOB">
                    </div>
                    <div class="col-sm-6">
                        <label>Aadhar Number</label>
                        <input  type="text" value="{{ $newDriver->aadhar_number }}" name="aadhar_number" class="form-control" >
                    </div> 

                    <div class="col-sm-6">
                        <label>Email</label>
                        <input  type="text"  value="{{ $newDriver->email }}" name="email" class="form-control" placeholder="Enter Email">
                    </div>

                    <div class="col-sm-6">
                        <label>State</label>
                        <select name="state" class="form-control">
                            @foreach($states as $state)
                                <option value="{{ $state->name }}" @selected($state->name == $newDriver->state)>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    <div class="col-sm-6">
                        <label>Password</label>
                        <input  type="text"  value="" name="password" class="form-control" >
                    </div>

                    <div class="col-sm-6">
                        <label>Address</label>
                        <textarea  type="text" value="{{ $newDriver->address }}" name="address" class="form-control">{{ $newDriver->address }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Aadhar Card</label>
                        <a target="_blank" href="{{ asset($newDriver->aadhar_pic) }}"><img class="dr-document" src="{{ asset($newDriver->aadhar_pic) }}"></a>
                    </div>
                    <div class="col-sm-6">
                        <label>Driving License</label>
                        <a target="_blank" href="{{ asset($newDriver->license_pic) }}"><img class="dr-document" src="{{ asset($newDriver->license_pic) }}"></a>
                    </div>
                </div>
                <hr>
                <h5 class="m-0">Cars List</h5>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <ul class="cars-list">
                            @foreach($newDriver->carsList as $carsList)
                                <li><a href="{{ route('cars.edit',$carsList->registration_number) }}"><i class="feather icon-eye m-0"></i> {{ $carsList->brand_name.' '.$carsList->model_name.' [ '.$carsList->registration_number.' ]' }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>        
              {{--  <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Car Brand</label>
                        <select  name="car_brand" class="form-control">
                            @foreach($carBrands as $carBrand)
                                <option value="{{ $carBrand->brand_name}}" @selected($newDriver->carDetails->brand_id == $carBrand->id)>{{ $carBrand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Car Model</label>
                        <select  name="car_model" class="form-control">
                            @foreach($carModels as $carModel)
                                <option value="{{ $carModel->model_name}}" @selected($newDriver->carDetails->model_id == $carModel->id)>{{ $carModel->model_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Driver ID</label>
                        <input  type="text"  value="{{ $newDriver->carDetails->driver_id }}" name="driver_id" class="form-control" >
                    </div>
                    <div class="col-sm-6">
                        <label>Registration Number</label>
                        <input  type="text" value="{{ $newDriver->carDetails->registration_number }}" name="registration_number" class="form-control" >
                    </div> 

                    <div class="col-sm-6">
                        <label>Chassis Number</label>
                        <input  type="text" value="{{ $newDriver->carDetails->chassis_number }}" name="chassis_number" class="form-control" >
                    </div>
                    <div class="col-sm-6">
                        <label>Engine Number</label>
                        <input  type="text" value="{{ $newDriver->carDetails->engine_number }}" name="engine_number" class="form-control" >
                    </div> 

                    <div class="col-sm-6">
                        <label>Locations</label>
                        <textarea  type="text" value="{{ $newDriver->carDetails->locations }}" name="locations" class="form-control">{{ $newDriver->carDetails->locations }}</textarea>
                    </div>

                    <div class="form-group  mt-5 row">
                        <div class="col-sm-2">
                            <label>Car RC</label>
                            <a target="_blank" href="{{ asset($newDriver->carDetails->car_rc) }}"><img class="dr-document" src="{{ asset($newDriver->carDetails->car_rc) }}"></a>
                        </div>
                    </div>
                    <div class="form-group mt-5 row">
                        @foreach(json_decode($newDriver->carDetails->car_images) as $key=> $carImages)
                            <div class="col-sm-2">
                                <a target="_blank" href="{{ asset($carImages) }}"><img class="dr-document" src="{{ asset($carImages) }}"></a>
                            </div>
                        @endforeach
                    </div>
                </div> --}}
                <button type="submit" class="btn btn-primary primary-btn">Save</button>
            </form>
        </div>
    </div>
</div>
<x-include-plugins imagePreview></x-include-plugins>
<script>
$(function() {

    $('#vehicle_number').select2();

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

function validateDOB() {
    var dobInput = document.getElementById('dob').value;
    
    var dob = new Date(dobInput);
    var today = new Date();
    var age = today.getFullYear() - dob.getFullYear();

    var dobMonth = dob.getMonth();
    var todayMonth = today.getMonth();
    if (todayMonth < dobMonth || (todayMonth === dobMonth && today.getDate() < dob.getDate())) {
        age--;
    }
    
    if (age < 18 || age > 45) {
        alert('Age must be between 18 and 45 years.');
        return false;
    }
    
    return true; 
}
    
var form = document.getElementById('drivers'); 
form.addEventListener('submit', function(event) {
    if (!validateDOB()) {
        event.preventDefault(); 
    }
});

function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
        var dataURL = reader.result;
        var img = document.getElementById('profilePic');
        img.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
}
$('#change_pic').click(function(){
   $('[name="profile_pic"]').click(); 
});
</script>
@endsection