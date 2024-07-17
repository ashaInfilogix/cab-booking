<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;


class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plan.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $plan = Plan::create([
            "plan_name" => $request->plan_name,
            "amount" => $request->amount,
            "description" => $request->description,
            "list_of_points" => json_encode(explode(",",$request->list_of_points)),
            "status" => $request->status
        ]);
        return redirect()->route('plans.index')->with('success','Plan Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plan = Plan::find($id);
        return view('admin.plan.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plan = Plan::where('id',$id)->update([
            "plan_name" => $request->plan_name,
            "amount" => $request->amount,
            "description" => $request->description,
            "list_of_points" => json_encode(explode(",",$request->list_of_points)),
            "status" => $request->status
        ]);

        return redirect()->route('plans.index')->with('success','Plan Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
