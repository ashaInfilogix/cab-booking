<div class="main-login main-center">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h4>Car Details</h4>
    <form class="form-horizontal" method="post" action="{{ route('car.detail') }}" enctype="multipart/form-data">
        @csrf									
        <input type="hidden" value="{{ $id }}" class="form-control" name="driver_id"/>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="car-company" class="cols-sm-2 control-label">Car Company</label>
                <div class="input-group remove">
                    <select name="brand_id" id="brand_list" class="form-control">
                        <option value="">--Select Company--</option>
                        @foreach ($carBrands as $carBrand)
                            <option value="{{ $carBrand->id }}">{{ $carBrand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="car-model" class="cols-sm-2 control-label">Car Model</label>
                <div class="input-group remove">
                    <select name="model_id" id="model_list" class="form-control">
                        <option>--Select Car Model--</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <label for="rg-number" class="cols-sm-2 control-label">Registration Number</label>
                <div class="input-group remove">
                    <input type="text" class="form-control" name="registration_number" id="registeration_number"  placeholder="Eg : PB65AA0000"/>
                </div>
            </div>
            <div class="col-md-6">
                <label for="ch-number" class="cols-sm-2 control-label">Chassis Number</label>
                <div class="input-group remove">
                    <input type="text" class="form-control" name="chassis_number" id="chassis_number"  placeholder="Chassis no : 1HGCM82633A123456"/>
                </div>
            </div>

            <div class="col-md-6">
                <label for="eng-number" class="cols-sm-2 control-label">Engine Number</label>
                <div class="input-group remove">
                    <input type="text" class="form-control" name="engine_number" id="engine_number"  placeholder="Engine no : PJ12345U123456P"/>
                </div>
            </div>

            <div class="col-md-6">
                <label for="eng-number" class="cols-sm-2 control-label">Locations <small style="color:red;">(Enter Location with comma seperate)</small></label>
                <div class="input-group remove">
                    <textarea type="text" class="form-control" name="locations" placeholder="Enter Location Like : Chandigarh, Mohali, Kullu, Manali"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <label for="eng-number" class="cols-sm-2 control-label">Upload Car RC</label>
                <div class="input-group remove">
                    <input type="file" name="car_rc" id="imageInput" required>
                </div>
                <div id="image_preview"></div>
            </div>

            <div class="col-md-6">
                <label for="eng-number" class="cols-sm-2 control-label">Upload Car Images</label>
                <div class="input-group remove">
                    <input type="file" name="car_images[]" id="images" multiple required>
                </div>
                <div id="image_preview_new"></div>
            </div>
        </div>
        <div class="form-group ">
            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Proceed</button>
        </div>
    </form>
</div>