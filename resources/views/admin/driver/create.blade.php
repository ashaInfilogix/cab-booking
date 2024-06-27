@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Add Driver</h5>
            <a href="{{ route('drivers.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form id="drivers" action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Driver Name</label>
                        <input type="text" name="driver_name" class="form-control" placeholder="Driver Name">
                    </div> 
                    <div class="col-sm-6">
                        <label>License Number</label>
                        <input type="text"  name="license_number" class="form-control" placeholder="Enter License Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Contact Number</label>
                        <input type="number" name="contact_number" class="form-control" placeholder="Enter Contact Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>Vehicle Number</label>
                        <select id="vehicle_number" name="vehicle_number" class="form-control">
                            <option value="">--- Select Vehicle Number ---</option>
                            @isset($cars)
                                @foreach ($cars as $car)
                                    <option value="{{ $car->VIN }}">{{ $car->VIN }}</option>
                                @endforeach
                            @endisset    
                        </select>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Driver Status</label>
                        <select name="driver_status" class="form-control">
                            <option value="">--- Select Driver Status ---</option>
                            <option value="active">Active</option>
                            <option value="leave">Leave</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>DOB</label>
                        <input type="date"  id="dob" name="dob" class="form-control" placeholder="Enter DOB">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Emergency Contact</label>
                        <input type="number" name="emergency_contact" class="form-control" placeholder="Enter Emergency Contact">
                    </div> 
                    <div class="col-sm-6">
                        <label>Insurance Details</label>
                        <input type="text"  name="insurance_details" class="form-control" placeholder="Enter Insurance Details">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Address</label>
                        <textarea type="text"  name="address" class="form-control" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label>Location</label>
                        <input type="text"  name="location" class="form-control" placeholder="Enter Location">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Choose photo</label>
                        <input type="file"  id="imageInput" name="image" class="form-control" >
                        <div id="image_preview"></div>
                    </div>
                </div>
                <h5 class="m-0">Payment Information</h5>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name">
                    </div> 
                    <div class="col-sm-6">
                        <label>Branch Name</label>
                        <input type="text"  name="bank_branch" class="form-control" placeholder="Enter Branch Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Account Number</label>
                        <input type="number" name="account_number" class="form-control" placeholder="Enter Account Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>IFSC Code</label>
                        <input type="text"  name="ifsc_code" class="form-control" placeholder="Enter IFSC Code">
                    </div>
                </div>
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
           // vehicle_number: "required",
            driver_status: "required",
            location: "required",
        },
        messages: {
            driver_name: "Please enter driver name",
            license_number: "Please enter license number",
            contact_information: "Please enter contact infomation",
           // vehicle_number: "Please select vehicle number",
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
});

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
</script>
@endsection