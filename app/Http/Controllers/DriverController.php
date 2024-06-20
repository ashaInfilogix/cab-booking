<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use App\Models\BankDetail;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::with('carDetails')->get();
        return view('admin.driver.index',compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        return view('admin.driver.create',compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasfile('image')){

            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers-image/'), $filename);
            $filePath = 'uploads/drivers-image/'.$filename;
        }else{
            $filePath = '';
        }    
        $driver = Driver::create([
            'driver_name' => $request->driver_name,
            'driver_id' => $this->randomId(),
            'license_number' => $request->license_number,
            'contact_number' => $request->contact_number,
            'vehicle_number' => $request->vehicle_number,
            'location' => $request->location,
            'emergency_contact' => $request->emergency_contact,
            'insurance_details' => $request->insurance_details,
            'address' => $request->address,
            'driver_status' => $request->driver_status,
            'profile_image' => $filePath,
        ]);

        $bankDetails = BankDetail::create([
            'driver_id' => $driver->id,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code
        ]);
        return redirect()->route('drivers.index')->with('success', 'Driver Added successfully');
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
        $drivers = Driver::with('carDetails')->with('bankDetails')->where('id',$id)->first();
        $cars = Car::all();

        return view('admin.driver.edit',compact('drivers','cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->hasfile('image')){

            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers-image/'), $filename);
            $filePath = 'uploads/drivers-image/'.$filename;
        }else{
            $filePath = '';
        }    
        $driver = Driver::where('id',$id)->update([
            'driver_name' => $request->driver_name,
            'license_number' => $request->license_number,
            'contact_number' => $request->contact_number,
            'vehicle_number' => $request->vehicle_number,
            'location' => $request->location,
            'emergency_contact' => $request->emergency_contact,
            'insurance_details' => $request->insurance_details,
            'address' => $request->address,
            'driver_status' => $request->driver_status,
            'profile_image' => $filePath
        ]);

        $bankDetails = BankDetail::where('id',$id)->update([
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code
        ]);

        return redirect()->route('cars.index')->with('success', 'Car Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function randomId(){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
}
