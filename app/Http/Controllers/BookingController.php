<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Notification;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::latest()->get();
        $confirmeds = Booking::where('booking_status','confirmed')->latest()->get();
        $completeds = Booking::where('booking_status','completed')->latest()->get();
        $cancelleds = Booking::where('booking_status','cancelled')->latest()->get();

        return view('admin.bookings.index',compact('bookings','confirmeds','completeds','cancelleds'));
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
        $booking = Booking::create([
            "pick_up"=>$request->pick_up,
            "drop_off"=>$request->drop_off,
            "passengers"=>$request->passengers,
            "pick_up_date"=>$request->pick_up_date,
            "pick_up_time"=>$request->pick_up_time,
            "user_email"=>$request->user_email,
            "contact_number"=>$request->contact_number,
        ]);
        Notification::create([
            "booking_id" => $booking->id,
            "title" => "New Booking",
            "message" => $request->pick_up.' to '.$request->drop_off,
            "type" => "booking"
        ]);
        return redirect()->route('home')->with('success', 'Your request successfully submitted, We will contact with you soon.');

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
        return view('admin.bookings.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookings = Booking::find($id);
        $bookings->booking_status = $request->status;
        $bookings->save();
        return response()->json(['success'=>'Booking '.$request->status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
