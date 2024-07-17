@extends('layouts.admin.admin-layout')
@section('content')
<div class="pcoded-inner-content">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Create Plan</h5>
            <a href="{{ route('plans.index') }}" class="btn btn-primary btn-md primary-btn">Back</a>
        </div>   
        <div class="card-block">
            <form action="{{ route('plans.store')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Plan Name</label>
                        <input type="text" name="plan_name" class="form-control" placeholder="Enter Plan Name" required>
                    </div>
                    <div class="col-sm-6">
                        <label>Plan Amount</label>
                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required>
                    </div>
                    <div class="col-sm-6">
                        <label>Plan Description</label>
                        <textarea name="description" class="form-control" placeholder="Enter Description" required></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label>Points List <small style="color:red">(Eg : First point, Second point, Third point)</small></label>
                        <textarea name="list_of_points" class="form-control" placeholder="Enter Points List" required></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label>License Number</label>
                        <select name="status" class="form-control">
                            <option>---Select Status---</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary primary-btn">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection