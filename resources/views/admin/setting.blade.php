@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Settings</h5>
            <a href="{{ route('admin-home') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>
        @if (session('success'))
            <x-alert message="{{ session('success') }}"></x-alert>
        @endif   
        <div class="card-block">
            <form id="drivers" action="{{ route('update-setting') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Company Email</label>
                        <input type="text" value="{{ isset($settings->email) ? $settings->email : '' }}" name="email" class="form-control" placeholder="Enter Your Company Email">
                    </div> 
                    <div class="col-sm-6">
                        <label>Company Contact Number</label>
                        <input type="text" value="{{ isset($settings->phone_number) ? $settings->phone_number : '' }}" name="phone_number" class="form-control" placeholder="Enter Your Company Contac Number">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Company Address</label>
                        <textarea type="text"  name="address" class="form-control" placeholder="Enter Your Company Address">{{ isset($settings->address) ? $settings->address : '' }}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <label>About Us Description</label>
                        <textarea type="text"  name="about_us" class="form-control" placeholder="Enter Your About Us">{{ isset($settings->about_us) ? $settings->about_us : '' }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Facebook URL</label>
                        <input type="text" value="{{ isset($settings->facebook_url) ? $settings->facebook_url : '' }}" name="facebook_url" class="form-control" placeholder="Enter Your Facebook URL">
                    </div> 
                    <div class="col-sm-6">
                        <label>Instagram URL</label>
                        <input type="text" value="{{ isset($settings->instagram_url) ? $settings->instagram_url : '' }}" name="instagram_url" class="form-control" placeholder="Enter Your Instagram URL">
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Twitter URL</label>
                        <input type="text" value="{{ isset($settings->twitter_url) ? $settings->twitter_url : '' }}" name="twitter_url" class="form-control" placeholder="Enter Your Twitter URL">
                    </div> 
                    <div class="col-sm-6">
                        <label>Linkedin URL</label>
                        <input type="text" value="{{ isset($settings->linkedin_url) ? $settings->linkedin_url : '' }}" name="linkedin_url" class="form-control" placeholder="Enter Your Linkedin URL">
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