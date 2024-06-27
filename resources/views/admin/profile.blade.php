@extends('layouts.admin.admin-layout')
@section('content')
    <div class="pcoded-inner-content">
        @if (session('success'))
            <x-alert message="{{ session('success') }}"></x-alert>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Profile</h5>
                <a href="{{ route('admin-home') }}" class="btn btn-primary btn-md primary-btn">Back To Dashboard</a>
            </div>
            <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                <div class="profile-container">
                    @csrf
                    <div class="left-card">
                        <h4 class="user-name">{{ Auth::user()->name }}</h4>
                        <div class="user-profile" id="image_preview">
                            @isset(Auth::user()->profile_pic)
                                <img class="u-img" src="{{ asset(Auth::user()->profile_pic) }}">
                            @else
                                <img class="u-img" src="{{ asset('assets/img/admin/avatar-4.jpg') }}">
                            @endisset
                        </div>
                        <input type="file" name="image" id="imageInput" style="display:none;">
                        <p class="change-pic"><a href="#" onclick="changePic();">Change picture</a></p>
                    </div>
                    <div class="right-card">
                        <div class="form-group row">
                            @php 
                                $name = explode(" ", Auth::user()->name);
                            @endphp
                            <div class="col-sm-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="{{ $name[0] }}" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-sm-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="{{ isset($name[1]) ? $name[1] : '' }}" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Enter Your Email">
                            </div>
                            <div class="col-sm-6">
                                <label>Contact Number</label>
                                <input type="number" name="contact_number" value="{{ Auth::user()->contact_number }}" class="form-control"
                                    placeholder="Enter Contact Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="col-sm-6">
                                <label>Password Confirm</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Enter Confirm Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-md primary-btn">Save</button>
                        </div>
                </div>
            </form>
        </div>

    </div>
    </div>
    <x-include-plugins imagePreview></x-include-plugins>
    <script>
        function changePic() {
            $('[type="file"]').click();
        }
    </script>
@endsection
