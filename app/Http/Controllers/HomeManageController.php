<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RatingComment;
use App\Mail\InformEmail;
use Illuminate\Support\Facades\Mail;

class HomeManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = User::role('Driver')->with('carDetails')->where('status','=','active')->get();
        foreach ($drivers as $driver) {
            $sumRating = RatingComment::where('driver_id', $driver->driver_id)->sum('rating');
            $totalRecord = RatingComment::where('driver_id', $driver->driver_id)->count();
        
            if ($totalRecord > 0) {
                $driver->totalRating = number_format(($sumRating) / $totalRecord, 2);
            } else {
                $driver->totalRating = 0; 
            }
        }    
        return view('admin.home-manage.index',compact('drivers'));
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
        $status = User::where('driver_id','=',$request->input('driver_id'))->first();
        $status->position = $request->input('position');
        $status->show_on = $request->input('status');
        $status->save();
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
        //
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

    public function sendEmail(){
        $data = array('title'=>"Test Mail", 'messsage'=> 'This is for testing purpose');

        $email = Mail::to('satwinderit7@gmail.com')->send(new InformEmail($data));

        echo '<pre>';
        print_r($email);

    }
}
