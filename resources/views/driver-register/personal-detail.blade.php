<div class="main-login main-center">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h4>Personal Details</h4>
    <form id="form" class="form-horizontal" method="post" action="{{ route('drivers.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-md-6">
                <label for="first" class="cols-sm-2 control-label">First Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="first_name" id="first_name"  placeholder="Enter your first" required/>
                </div>
            </div>
            <div class="col-md-6">
                <label for="last" class="cols-sm-2 control-label">Last Name</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="last_name" id="last_name"  placeholder="Enter your last" required/>
                </div>
            </div>

            <div class="col-md-6">
                <label for="email" class="cols-sm-2 control-label">Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="email" id="email"  placeholder="Enter your email" required/>
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="cols-sm-2 control-label">Password</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                    <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required/>
                </div>
            </div>

            <div class="col-md-6">
                <label for="phone" class="cols-sm-2 control-label">Mobile Number</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i></span>
                    <input type="number" class="form-control" name="contact_number" id="contact_number"  placeholder="Enter your mobile number" required/>
                </div>
            </div>
            <div class="col-md-6">
                <label for="dob" class="cols-sm-2 control-label">Date of Birth</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar fa-lg" aria-hidden="true"></i></span>
                    <input type="date" class="form-control" name="dob" id="dob"  placeholder="Enter your date of birth" required/>
                </div>
            </div>

            <div class="col-md-6">
                <label for="state" class="cols-sm-2 control-label">State</label>
                <div class="input-group remove">
                    <select class="form-control" name="state" required>
                        <option value="Punjab">---Select State---</option>
                        @foreach($states as $state)
                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="address" class="cols-sm-2 control-label">Addres</label>
                <div class="input-group remove">
                    <textarea class="form-control" name="address" id="address"  placeholder="Enter Address" required></textarea>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="aadhar" class="cols-sm-2 control-label">Aadhar Number</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    </span>
                    <input type="number" class="form-control" name="aadhar_number" id="aadhar_number"  placeholder="Enter your aadhar number" required/>
                </div>
                <small id="aadhar_msg" style="color:red;"></small>
            </div>
            <div class="col-md-6">
                <label for="license" class="cols-sm-2 control-label">Driving License Number</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control" name="license_number" id="license_number"  placeholder="Enter your license number" required/>
                </div>
                <small id="license_msg" style="color:red;"></small>
            </div>

            <div class="col-md-6">
                <label for="aadhar" class="cols-sm-2 control-label">Upload Aadhar</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="aadhar_pic" id="image_preview" required/>
                </div>
                <div id="aadhar_pic"></div>
            </div>
            <div class="col-md-6">
                <label for="aadhar" class="cols-sm-2 control-label">Upload License</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="license_pic" id="image_preview" required/>
                </div>
                <div id="license_pic"></div>
            </div>

            <div class="col-md-6">
                <label for="aadhar" class="cols-sm-2 control-label">Upload Profile Photo</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="profile_pic" id="image_preview"  placeholder="Enter your license number" required/>
                </div>
                <div id="profile_pic"></div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Proceed </button>
        </div>
    </form>
</div>