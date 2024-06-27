@extends('layouts.frontend-layout')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">

	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
		<link href="{{ asset('assets/css/driver.css') }}" rel='stylesheet' type='text/css'>
        <script src="{{ asset('assets/js/driver.js') }}"></script>
		<title>Driver Register</title>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Driver Register</h1>
	               		<hr />
	               	</div>
	            </div> 
				@if(isset($id))
					@include('driver-register.car-form')		
				@else
					@include('driver-register.personal-detail')
				@endisset
			</div>
		</div>
<x-include-plugins multipleImage></x-include-plugins>
<x-include-plugins imagePreview></x-include-plugins>
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

/*$(function() {
    $('#form').validate({
        rules: {
            first_name: "required"
        },
        messages: {
            first_name: "Please enter year name"
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
})*/
</script>
@endsection