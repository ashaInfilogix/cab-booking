@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Payments List</h5>

        </div>
        <table id="plan-list" class="table table-striped table-bordered nowrap">
            <thead class="text-center">
                <tr>
                    <th>Transection ID</th>
                    <th>Subscription ID</th>
                    <th>Amount</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @role('Driver')   
                    @foreach($payments->getTransaction as $payment)
                    <tr> 
                        <td>{{ $payment->trasnaction_id }}</td>    
                        <td>{{ $payment->subscripton_id }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->created_at }}</td>
                        @if($payment->status == 'completed')    
                            <td style="color:green;">{{ $payment->status }}</td>
                        @else
                            <td style="color:red;">{{ $payment->status }}</td>
                        @endif   
                    </tr> 
                    @endforeach  
                @else
                    @foreach($payments as $payment)
                    <tr> 
                        <td>{{ $payment->trasnaction_id }}</td>    
                        <td>{{ $payment->subscripton_id }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->created_at }}</td>
                        @if($payment->status == 'completed')    
                            <td style="color:green;">{{ $payment->status }}</td>
                        @else
                            <td style="color:red;">{{ $payment->status }}</td>
                        @endif   
                    </tr> 
                    @endforeach    
                @endrole    
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