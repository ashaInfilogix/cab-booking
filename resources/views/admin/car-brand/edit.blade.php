@extends('layouts.admin.admin-layout')

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Add Car Brand</h5>
                                        <a href="{{ route('car-brand.index') }}" class="btn btn-primary primary-btn btn-md">
                                            <i class="feather icon-arrow-left"></i>
                                            Go Back
                                        </a>
                                </div>

                                <div class="card-block">
                                    <form action="{{ route('car-brand.update', $brandDetails->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <x-input-text name="brand_name" label="Brand Name" value="{{ $brandDetails->brand_name }}"></x-input-text>
                                        </div>
                                        <div class="form-group">
                                            <label for="add-brand-logo">Brand Logo</label>
                                            <div class="custom-file">
                                                <input type="file" id="imageInput" name="brand_logo" class="custom-file-input" id="add-brand-logo">
                                                <label class="custom-file-label" for="add-brand-logo">Choose Brand Logo</label>
                                                <div id="image_preview"><img width="150" height="150" src="{{ asset($brandDetails->brand_image) }}"></div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary primary-btn">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-include-plugins imagePreview></x-include-plugins>
    <script>
        $(function() {
            $('form').validate({
                rules: {
                    category_id: "required",
                    brand_name: "required",
                    brand_logo: "required"
                },
                messages: {
                    category_id: "Please enter category name",
                    brand_name: "Please enter brand name",
                    brand_logo: "Please choose brand logo"
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
