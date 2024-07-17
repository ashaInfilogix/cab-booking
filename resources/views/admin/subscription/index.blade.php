@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Subscriptions List</h5>

        </div>
        <table id="plan-list" class="table table-striped table-bordered nowrap">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Subscription ID</th>
                    <th>Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="text-center">   
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td>#</td>    
                        <td>{{ $subscription->subscripton_id }}</td>    
                        <td>{{ $subscription->driver_id }}</td>
                        <td>{{ $subscription->created_at }}</td>
                        <td>{{ $subscription->end_date }}</td>
                        @if($subscription->status == 'active')    
                            <td style="color:green;">{{ $subscription->status }}</td>
                        @else
                            <td style="color:red;">{{ $subscription->status }}</td>
                        @endif   
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
        })
    </script>
@endsection