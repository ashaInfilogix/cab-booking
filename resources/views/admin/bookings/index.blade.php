@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="row m-b-30">
            <div class="col-lg-12 col-xl-12">
                <h4>Bookings</h4>

                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#newBooking" role="tab"
                            aria-selected="true"><i class="fa fa-taxi" aria-hidden="true"></i> New Bookings</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#confirmed" role="tab"
                            aria-selected="false" style="color: orange;"><i class="fa fa-hourglass-half" aria-hidden="true"></i> 
                            Progress</a>
                        <div class="slide" style="background:orange;"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#completed" role="tab"
                            aria-selected="false" style="color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i> 
                            Completed</a>
                        <div class="slide" style="background:green;"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cancelled" role="tab"
                            aria-selected="false" style="color:red;"><i class="fa fa-ban" aria-hidden="true"></i>
                             Cancelled</a>
                        <div class="slide" style="background:red;"></div>
                    </li>
                </ul>

                <div class="tab-content card-block">
                    <div class="tab-pane active show" id="newBooking" role="tabpanel">
                        <div class="dt-responsive table-responsive">
                            <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Pick Up</th>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Drop Off</th>
                                        <th><i class="fa fa-calendar" aria-hidden="true"></i> Date & Time</th>
                                        <th><i class="fa fa-list" aria-hidden="true"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($bookings as $booking)    
                                    <tr>
                                        <td>{{ $booking->pick_up }}</td>
                                        <td>{{ $booking->drop_off }}</td>
                                        <td>{{ $booking->pick_up_date.' '.$booking->pick_up_time }}</td>
                                        <td>
                                            <a href="{{ route('bookings.edit',$booking->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> view booking</a>
                                            <select class="form-control" id="change-trip-status" data-trip-id="{{ route("bookings.update",$booking->id) }}">
                                                <option value="waiting" @selected('waiting' == $booking->booking_status)>Waiting</option>
                                                <option value="confirmed" @selected('confirmed' == $booking->booking_status)>Confirmed</option>
                                                <option value="completed" @selected('completed' == $booking->booking_status)>Completed</option>
                                                <option value="cancelled" @selected('cancelled' == $booking->booking_status)>Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach    
                                </tbody>
                            </table>
                        </div>    
                    </div>
                    <div class="tab-pane" id="confirmed" role="tabpanel">
                        <div class="dt-responsive table-responsive">
                            <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Pick Up</th>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Drop Off</th>
                                        <th><i class="fa fa-calendar" aria-hidden="true"></i> Date & Time</th>
                                        <th><i class="fa fa-list" aria-hidden="true"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($confirmeds as $confirmed)    
                                    <tr>
                                        <td>{{ $confirmed->pick_up }}</td>
                                        <td>{{ $confirmed->drop_off }}</td>
                                        <td>{{ $confirmed->pick_up_date.' '.$confirmed->pick_up_time }}</td>
                                        <td>
                                            <a href="{{ route('bookings.edit',$confirmed->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> view booking</a>
                                            <select class="form-control" id="change-trip-status" data-trip-id="{{ route("bookings.update",$confirmed->id) }}">
                                                <option value="waiting" @selected('waiting' == $confirmed->booking_status)>Waiting</option>
                                                <option value="confirmed" @selected('confirmed' == $confirmed->booking_status)>Confirmed</option>
                                                <option value="completed" @selected('completed' == $confirmed->booking_status)>Completed</option>
                                                <option value="cancelled" @selected('cancelled' == $confirmed->booking_status)>Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach    
                                </tbody>
                            </table>
                        </div>   
                    </div>
                    <div class="tab-pane" id="completed" role="tabpanel">
                        <div class="dt-responsive table-responsive">
                            <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Pick Up</th>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Drop Off</th>
                                        <th><i class="fa fa-calendar" aria-hidden="true"></i> Date & Time</th>
                                        <th><i class="fa fa-list" aria-hidden="true"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($completeds as $completed)    
                                    <tr>
                                        <td>{{ $completed->pick_up }}</td>
                                        <td>{{ $completed->drop_off }}</td>
                                        <td>{{ $completed->pick_up_date.' '.$completed->pick_up_time }}</td>
                                        <td>
                                            <a href="{{ route('bookings.edit',$completed->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> view booking</a>
                                            <select class="form-control" id="change-trip-status" data-trip-id="{{ route("bookings.update",$completed->id) }}">
                                                <option value="waiting" @selected('waiting' == $completed->booking_status)>Waiting</option>
                                                <option value="confirmed" @selected('confirmed' == $completed->booking_status)>Confirmed</option>
                                                <option value="completed" @selected('completed' == $completed->booking_status)>Completed</option>
                                                <option value="cancelled" @selected('cancelled' == $completed->booking_status)>Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach    
                                </tbody>
                            </table>
                        </div>   
                    </div>
                    <div class="tab-pane" id="cancelled" role="tabpanel">
                        <div class="dt-responsive table-responsive">
                            <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Pick Up</th>
                                        <th><i class="fa fa-crosshairs" aria-hidden="true"></i> Drop Off</th>
                                        <th><i class="fa fa-calendar" aria-hidden="true"></i> Date & Time</th>
                                        <th><i class="fa fa-list" aria-hidden="true"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($cancelleds as $cancelled)    
                                    <tr>
                                        <td>{{ $cancelled->pick_up }}</td>
                                        <td>{{ $cancelled->drop_off }}</td>
                                        <td>{{ $cancelled->pick_up_date.' '.$cancelled->pick_up_time }}</td>
                                        <td>
                                            <a href="{{ route('bookings.edit',$cancelled->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> view booking</a>
                                            <select class="form-control" id="change-trip-status" data-trip-id="{{ route("bookings.update",$cancelled->id) }}" >
                                                <option value="waiting" @selected('waiting' == $cancelled->booking_status)>Waiting</option>
                                                <option value="confirmed" @selected('confirmed' == $cancelled->booking_status)>Confirmed</option>
                                                <option value="completed" @selected('completed' == $cancelled->booking_status)>Completed</option>
                                                <option value="cancelled" @selected('cancelled' == $cancelled->booking_status)>Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach    
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-include-plugins dataTable></x-include-plugins>
<script>
    $(function() {
        $('#table-style-hover').DataTable({
            searching: true
        });
     });

    //Change trip status 
    $('select#change-trip-status').change(function(){
        var url = $(this).data('trip-id');
        var status = $(this).val();
        $.ajax({
            url : url,
            type : 'PUT',
            data : {
                '_token': '{{ csrf_token() }}',
                status : status
            },success : function(resp){
                swal({
                    title: "",
                    text: `${resp.success}`,
                    type: "success",
                    timer : 1000,
                    showConfirmButton: false
                });
                window.location.reload();
            }
        }); 
    });
</script>
@endsection
