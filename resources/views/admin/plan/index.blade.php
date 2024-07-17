@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    @if (session('success'))
        <x-alert message="{{ session('success') }}"></x-alert>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Drivers List</h5>
            <a href="{{ route('plans.create') }}" class="btn btn-primary btn-md primary-btn">Create a plan</a>
        </div>
        <table id="plan-list" class="table table-striped table-bordered nowrap">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Plan Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">   
                @foreach($plans as $plan)
                    <tr>
                        <td>#</td>    
                        <td>{{ $plan->plan_name }}</td>    
                        <td>{{ $plan->amount }}</td>    
                        <td>{{ $plan->status }}</td>
            
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('plans.edit',$plan->id) }}"
                                    class="btn btn-primary primary-btn waves-effect waves-light mr-2 edit-plans">
                                    <i class="feather icon-eye m-0"></i> View Details
                                </a>
                            </div>
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
        })
    </script>
@endsection