@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">View Booking</h5>
            <a href="{{ route('bookings.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form id="drivers" action="{{ route('bookings.update',1) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Pick Up</label>
                        <input type="text" name="pick_up" class="form-control" placeholder="Pick Up">
                    </div> 
                    <div class="col-sm-6">
                        <label>Drop Off</label>
                        <input type="text"  name="drop_off" class="form-control" placeholder="Drof Off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>User Email</label>
                        <input type="text"  name="user_email" class="form-control" placeholder="User Email">
                    </div>
                    <div class="col-sm-6">
                        <label>Contact Number</label>
                        <input type="number"  name="contact_number" class="form-control" placeholder="Contact Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Passengers</label>
                        <input type="number" name="passengers" class="form-control" placeholder="Number of Passengers">
                    </div> 
                    <div class="col-sm-6">
                        <label>Cab Type</label>
                        <input type="text"  name="cab_type" class="form-control" placeholder="Cab Type">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Pick Up Date</label>
                        <input type="date"  name="pick_up_date" class="form-control" placeholder="Pick Up Date">
                    </div>
                    <div class="col-sm-6">
                        <label>Pick Up Time</label>
                        <input type="time"  name="pick_up_time" class="form-control" placeholder="Pick Up Time">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Driver Age</label>
                        <input type="number"  name="driver_age" class="form-control" placeholder="Driver Age">
                    </div>
                    <div class="col-sm-6">
                        <label>Cab Model</label>
                        <input type="text"  name="cab_model" class="form-control" placeholder="Cab Model">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary primary-btn">Save</button>
            </form>
        </div>
    </div>
</div>

<script>

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


</script>
@endsection