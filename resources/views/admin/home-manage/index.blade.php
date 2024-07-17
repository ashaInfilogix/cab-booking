@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Home Manage List</h5>

        </div>
        <table id="plan-list" class="table table-striped table-bordered nowrap">
            <thead class="text-center">
                <tr>
                    <th>Driver ID</th>
                    <th>Driver Name</th>
                    <th>Vehicle Number</th>
                    <th>Rating</th>
                    <th>Show on </th>
                </tr>
            </thead>
            <tbody class="text-center">   
             @foreach($drivers as $driver)
                    <tr> 
                        <td>{{ $driver->driver_id }}</td>    
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->carDetails->registration_number }}</td>
                        <td>                            
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= $driver->totalRating)
                                <i class="fa fa-star" aria-hidden="true" style="color:#fdb100"></i>
                            @else
                                <i class="fa fa-star" aria-hidden="true"></i>
                            @endif
                        @endfor 
                        (Rating : {{  $driver->totalRating }})
                        </td>
                        <td class="action">
                            <input type="number" value="{{ $driver->position }}" placeholder="Enter Position" id="{{ $driver->driver_id }}" >
                            <label class="switch">
                                <input type="checkbox" value="show" @checked('show' == $driver->show_on) id="display_on" data-driver-id="{{ $driver->driver_id }}">
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <x-include-plugins dataTable></x-include-plugins>
    <script>
        $(function() {
            $('#plan-list').DataTable({
                searching: true
            });


        });
        $('input#display_on').change(function(){
            var driver_id = $(this).data('driver-id');
            var position = $('#'+driver_id).val();

            if(!position){
                alert('Please enter position '+driver_id);
                $('[data-driver-id="DR-10003"]').prop('checked', false);
                return false; 
            }else{
                if($(this).is(':checked')){
                    var status = $(this).val();
                }else{
                    var status = 'Off';
                }
                $.ajax({
                    url: "{{ url('admin/update-status') }}",
                    type: "POST",
                    data: {
                        position: position,
                        status: status,
                        driver_id : driver_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        console.log(result);
                    },error : function(err){
                        console.log(err);
                    }
                });
            }    
            

        });
    </script>
@endsection