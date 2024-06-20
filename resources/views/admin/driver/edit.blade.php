@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Edit Driver Details</h5>
            <a href="{{ route('drivers.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form action="{{ route('drivers.update',$drivers->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group text-align-left">
                    <img  height="150px" src="{{ asset($drivers->profile_image)}}">
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Driver Name</label>
                        <input type="text" value="{{ $drivers->driver_name }}" name="driver_name" class="form-control" placeholder="Driver Name">
                    </div> 
                    <div class="col-sm-6">
                        <label>License Number</label>
                        <input type="text"  value="{{ $drivers->license_number }}" name="license_number" class="form-control" placeholder="Enter License Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Contact Number</label>
                        <input type="number" value="{{ $drivers->contact_number }}" name="contact_number" class="form-control" placeholder="Enter Contact Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>Vehicle Number</label>
                        <select id="vehicle_number" name="vehicle_number" class="form-control">
                            <option value="">--- Select Vehicle Number ---</option>
                            @foreach ($cars as $car)
                                <option value="{{ $car->VIN }}" @selected($car->VIN == $drivers->vehicle_number)>{{ $car->VIN }}</option>
                            @endforeach
                        </select>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Driver Status</label>
                        <select name="driver_status" class="form-control">
                            <option value="">--- Select Driver Status ---</option>
                            <option value="active" @selected('active' == $drivers->driver_status)>Active</option>
                            <option value="leave" @selected('leave' == $drivers->driver_status)>Leave</option>
                            <option value="suspended" @selected('suspended' == $drivers->driver_status)>Suspended</option>
                        </select>
                    </div> 
                    <div class="col-sm-6">
                        <label>Location</label>
                        <input type="text"  value="{{ $drivers->location }}" name="location" class="form-control" placeholder="Enter Location">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Emergency Contact</label>
                        <input type="number" value="{{ $drivers->emergency_contact }}" name="emergency_contact" class="form-control" placeholder="Enter Emergency Contact">
                    </div> 
                    <div class="col-sm-6">
                        <label>Insurance Details</label>
                        <input type="text"  value="{{ $drivers->insurance_details }}" name="insurance_details" class="form-control" placeholder="Enter Insurance Details">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Address</label>
                        <textarea type="text" value="{{ $drivers->address }}" name="address" class="form-control" placeholder="Enter Address">{{ $drivers->address }}</textarea>
                    </div>
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
                        <input type="text" value="{{ $drivers->bankDetails->bank_name }}" name="bank_name" class="form-control" placeholder="Enter Bank Name">
                    </div> 
                    <div class="col-sm-6">
                        <label>Branch Name</label>
                        <input type="text"  value="{{ $drivers->bankDetails->bank_branch }}" name="bank_branch" class="form-control" placeholder="Enter Branch Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Account Number</label>
                        <input type="number" value="{{ $drivers->bankDetails->account_number }}" name="account_number" class="form-control" placeholder="Enter Account Number">
                    </div> 
                    <div class="col-sm-6">
                        <label>IFSC Code</label>
                        <input type="text"  value="{{ $drivers->bankDetails->ifsc_code }}" name="ifsc_code" class="form-control" placeholder="Enter IFSC Code">
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
</script>
@endsection