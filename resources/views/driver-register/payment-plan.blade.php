@extends('layouts.frontend-layout')

@section('content')
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    font-family: 'Montserrat', sans-serif;
    font-size: 14px;
}
.wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(0, 1fr)); /* Adjusted minmax to minmax(0, 1fr) */
    justify-content: center; /* Center grid horizontally */
    grid-gap: 15px; /* Adds gap between grid items */
    margin: 50px; /* Adds margin around the grid */
    padding: 0px 20px; /* Adds padding inside the grid */
}
.pricing-table{
   box-shadow: 0px 0px 18px #ccc;
   text-align: center;
   padding: 30px 0px;
   border-radius: 5px;
   position: relative;
 
}
.pricing-table .head {
    border-bottom:1px solid #eee;
    padding-bottom: 50px;
    transition: all 0.5s ease;
}
.pricing-table:hover .head{
   border-bottom:1px solid #ffb300;
   
}


.pricing-table .head .title{
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: 700;
}

.pricing-table .content .price{
    background:linear-gradient(to right, #ffb300 0%, #ffb300 100%);
    width: 90px;
    height: 90px;
    margin: auto;
    line-height: 90px;
    border-radius: 50%;
    border: 5px solid #fff;
    box-shadow: 0px 0px 10px #ccc;
    margin-top: -50px;
     transition: all 0.5s ease;
}
.pricing-table:hover .content .price{
    transform: scale(1.2);
 
}
.pricing-table .content .price h1{
    color:#fff;
    font-size: 30px;
    font-weight: 700;
}
.pricing-table .content ul{
   list-style-type: none;
   margin-bottom: 20px;
   padding-top: 10px;
}

.pricing-table .content ul li{
    margin: 20px 0px;
    font-size: 14px;
    color:#555;
}

.pricing-table .content .sign-up{
    background: linear-gradient(to right, #ffb300 0%, #ffb300 100%);
    border-radius: 40px;
    font-weight: 500;
    position: relative;
    display: inline-block;
}


.pricing-table .btn {
	color: #fff;
	padding: 14px 40px;
	display: inline-block;
	text-align: center;
	font-weight: 600;
	-webkit-transition: all 0.3s linear;
	-moz-transition: all 0.3 linear;
	transition: all 0.3 linear;
	border: none;
	font-size: 14px;
	text-transform: capitalize;
	position: relative;
	text-decoration: none;
    margin: 2px;
    z-index: 9999;
    text-decoration: none;
    border-radius:50px;
 
}

.pricing-table .btn:hover{
	box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
}

.pricing-table .btn.bordered {
	z-index: 50;
	color: #333;
}
.pricing-table:hover .btn.bordered{
	color:#fff !important;
}

.pricing-table .btn.bordered:after {
	background: #fff none repeat scroll 0 0;
	border-radius: 50px;
	content: "";
	height: 100%;
	left: 0;
	position: absolute;
	top: 0;
	-webkit-transition: all 0.3s linear;
	-moz-transition: all 0.3 linear;
	transition: all 0.3 linear;
	width: 100%;
	z-index: -1;	
	-webkit-transform:scale(1);
	-moz-transform:scale(1);
	transform:scale(1);
}
.pricing-table:hover .btn.bordered:after{
	opacity:0;
	transform:scale(0);
}

@media screen and (max-width:768px){
   .wrapper{
        grid-template-columns: repeat(2,1fr);
    } 
}

@media screen and (max-width:600px){
   .wrapper{
        grid-template-columns: 1fr;
    } 
}
</style>
@if (session('message'))
<x-alert message="{{ session('message') }}"></x-alert>
@endif
<div class="wrapper">
    @foreach($plans as $plan)
        <div class="pricing-table gprice-single">
            <div class="head">
                <h4 class="title">{{ $plan->plan_name }}</h4>
            </div>
            <div class="content">
                <div class="price">
                    <h1>${{ $plan->amount }}</h1>
                </div>
                <ul>
                    @foreach(json_decode($plan->list_of_points) as $list)
                        <li>{{ $list }}</li>
                    @endforeach
                </ul>
                <div class="sign-up">
                    @if ($plan->amount>0)
                        <button class="btn" @disabled(true)>Buy Now</button>
                    @else
                    <a href="{{ route('make.payment', [
                        'id' => $plan->id,
                        'driver_id' => $id,
                        'price' => $plan->amount
                    ]) }}" class="btn bordered radius">Signup Now</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <!--div class="pricing-table gprice-single">
        <div class="head">
            <h4 class="title">Standard</h4>
        </div>
        <div class="content">
            <div class="price">
                <h1>$29</h1>
            </div>
            <ul>
                <li>5 GB Ram</li>
                <li>40GB SSD Cloud Storage</li>
                <li>Month Subscription</li>
                <li>Responsive Framework</li>
                <li>Monthly Billing Software</li>
                <li><del>1 Free Website</del></li>

            </ul>
            <div class="sign-up">
                <a href="#" class="btn bordered radius">Signup Now</a>
            </div>
        </div>
    </div-->
    <!--div class="pricing-table gprice-single">
        <div class="head">
            <h4 class="title">Premium</h4>
        </div>
        <div class="content">
            <div class="price">
                <h1>$39</h1>
            </div>
            <ul>
                <li>5 GB Ram</li>
                <li>40GB SSD Cloud Storage</li>
                <li>Month Subscription</li>
                <li>Responsive Framework</li>
                <li>Monthly Billing Software</li>
                <li>1 Free Website</li>
            </ul>
            <div class="sign-up">
                <a href="#" class="btn bordered radius">Signup Now</a>
            </div>
        </div>
    </div-->
</div>
@endsection