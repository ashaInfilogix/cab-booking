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
		<title>Driver View</title>
		<div class="row container-view">
            <div class="col-md-4" id="left-view">
                <div class="profile-view">
                    <img src="{{ asset($driverInfo->profile_pic)}}">
                </div>
                
                <h1>{{ $driverInfo->name.' '.$driverInfo->last_name }}</h1>
                <p>
                    @for ($i = 1; $i <= 5; $i++)
                        @if($i <= $totalRating)
                            <i class="fa fa-star" aria-hidden="true" style="color:#fdb100"></i>
                        @else
                            <i class="fa fa-star" aria-hidden="true"></i>
                        @endif
                    @endfor
                 <small> ( Rating : {{ $totalRating }} )</small>
                </p>    
                <p><i class="fa fa-phone" aria-hidden="true"></i> +91 {{ $driverInfo->contact_number}}</p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i> {{ $driverInfo->email}}</p>
                @foreach($driverInfo->carsList as $carinfo)
                    <p><i class="fa fa-map" aria-hidden="true"></i> {{ $carinfo->locations}}</p>
                @endforeach
            </div>
            <div class="col-md-8" id="right-view">
                <h3>Available Cars</h3>
                @foreach($driverInfo->carsList as $carinfo)
                <h4 class="car-title">{{ $carinfo->brand_name.' '.$carinfo->model_name }}</h4>
                    <div class="car-images">
                        @foreach(json_decode($carinfo->car_images) as $images)
                            <img src="{{ asset($images) }}" class="car-image">
                        @endforeach
                    </div>
                @endforeach
                {{-- Comments Section --}}    
                <hr/>
                <h4>Customers Review</h4>
                @foreach($ratings as $rating)
                    <div class="customer-review">
                        <p class="customer-name"><img src="https://w7.pngwing.com/pngs/15/560/png-transparent-verified-badge-symbol-computer-icons-twitter-discord-flat-icon-blue-text-logo-thumbnail.png">Users</p>
                        <p>
                            @for ($i = 1; $i <= 5; $i++)
                                @if($i <= $rating->rating)
                                    <i class="fa fa-star" aria-hidden="true" style="color:#fdb100"></i>
                                @else
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @endif
                            @endfor
                        </p>
                        <p class="comments">{{ $rating->comments }}</p>
                    </div>
                @endforeach
                <hr/>
                <div class="col-10">
                    <form id="submitForm" action="{{ route('ratings.store') }}" method="POST">  
                        <div class="comment-box ml-2">
                            @csrf
                            <input type="hidden" name="driver_id" value="{{ $driverInfo->driver_id }}" >
                            <h4>Add a comment</h4>
                            
                            <div class="rating"> 
                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                            </div>
                            
                            <div class="comment-area">
                                
                                <textarea class="form-control" name="comments" placeholder="what is your view?" rows="4" required></textarea>
                            
                            </div>
                            
                            <div class="comment-btns mt-2">
                                
                                <div class="row">
                                    
                                    <div class="col-6">
                                        
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="pull-right">
                                            <button id="submitBtn" class="btn btn-success send btn-sm">Submit <i class="fa fa-long-arrow-right ml-1"></i></button>          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                 {{-- Comments Section End--}}
            </div>    
		</div>
<script>
$(document).ready(function() {
    $('#submitBtn').click(function(event) {
        event.preventDefault();

        if ($('input[name="rating"]:checked').length === 0) {
            alert('Please select a rating!');
            return false; 
        }
        $('#submitForm').submit();
    });
});
</script>
@endsection