<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Mail\InformEmail;
use Illuminate\Support\Facades\Mail;

class UnderProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $newDrivers = User::role('Driver')->where('registration_status','processing')->get();

        return view('admin.under-process.index',compact('newDrivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user = User::where('driver_id','=',$id)->first();

        $data = array('title' => 'Your first step already completed' , 'message' => 'Hi '.$user->name.' '.$user->last_name.', Please proceed next step '.route('driver.register',base64_encode($id)));
        $email = Mail::to($user->email)->send(new InformEmail($data));
        return redirect()->route('under-process.index')->with('success','Email sent successfully to '.$id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
