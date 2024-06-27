<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use App\Models\User;
use App\Models\BankDetail;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\State;
use App\Models\CarDetail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newDrivers = User::role('Driver')->with('carDetails')->get();

        return view('admin.driver.index',compact('newDrivers'));
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

        $driver = User::create([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'dob' => $request->dob,
            'aadhar_number' => $request->aadhar_number,
            'aadhar_pic' => $request->aadhar_pic,
            'license_number' => $request->license_number,
            'license_pic' => $request->license_pic,
            'profile_pic' => $request->profile_pic,
            'address' => $request->address,
            'state' => $request->state,
            'password' => Hash::make($request->password),
            'status' => 'not_approved'
        ]);

        $driver->assignRole('Driver');

        //Generate Driver ID
        $driver_id = 'DR-1000'.$driver->id;

        $driver->driver_id = $driver_id;

        if($request->hasfile('profile_pic')){

            $file = $request->file('profile_pic');
            $filename = $driver_id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers-image/'), $filename);
            $profile_pic = 'uploads/drivers-image/'.$filename;
            $driver->profile_pic =  $profile_pic;
        }
        if($request->hasfile('license_pic')){

            $file = $request->file('license_pic');
            $filename = $driver_id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers-license/'), $filename);
            $license_pic = 'uploads/drivers-license/'.$filename;
            $driver->license_pic =  $license_pic;
        }
        if($request->hasfile('aadhar_pic')){

            $file = $request->file('aadhar_pic');
            $filename = $driver_id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers-aadhar/'), $filename);
            $aadhar_pic = 'uploads/drivers-aadhar/'.$filename;
            $driver->aadhar_pic =  $aadhar_pic;
        }       

        $driver->save();

        return redirect()->route('driver.register',base64_encode($driver_id))->with('success', 'Driver Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $newDriver = User::role('Driver')->with('carsList')->where('driver_id',$id)->first();

        foreach($newDriver->carsList as $carsList){
            $carBrand = CarBrand::find($carsList->brand_id);
            $carModel = CarModel::find($carsList->model_id);
            $carsList->brand_name = $carBrand->brand_name;
            $carsList->model_name = $carModel->model_name;
        }

        return view('admin.driver.edit',compact('newDriver'));
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
        
        //$user->assignRole('Customer');
        $driver = Driver::where('id',$id)->update([
            'driver_name' => $request->driver_name,
            'license_number' => $request->license_number,
            'contact_number' => $request->contact_number,
            'vehicle_number' => $request->vehicle_number,
            'location' => $request->location,
            'dob' => $request->dob,
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

        return redirect()->route('drivers.index')->with('success', 'Driver Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Driver::find($id);
        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => 'Driver deleted successfully.'
        ]);
    }
    
    public function carDetailsUpdate(Request $request){

        $existingCar = CarDetail::where('registration_number', $request->registration_number)->first(); 
        if ($existingCar) {
            // Redirect back with a message or to a specific route
            return redirect()->route('driver.register',$request->driver_id)->with('error', 'Registration Number already exists.');
        }
        $images = $request->car_images;
        if ($images) {
            $files = [];
            if($request->hasfile('car_images'))
            {
                foreach($request->file('car_images') as $file)
                {
                    $filename = uniqid().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('uploads/car-images/'), $filename);
     
                    $files[]  = 'uploads/car-images/'. $filename;

                }
            }
        }
        $driver_id = base64_decode($request->driver_id);
        if($request->hasfile('car_rc')){

            $file = $request->file('car_rc');
            $filename = $driver_id.'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers-rc/'), $filename);
            $car_rc = 'uploads/drivers-rc/'.$filename;
        }
        $carDetail = CarDetail::create([
            'driver_id' => $driver_id,
            'brand_id' => $request->brand_id,
            'model_id' => $request->model_id,
            'registration_number' => $request->registration_number,
            'chassis_number' => $request->chassis_number,
            'engine_number' => $request->engine_number,
            'locations' => $request->locations,
            'car_images' => json_encode($files),
            'car_rc' =>  $car_rc
        ]);
        return redirect()->route('payment.plan',['id'=>$request->driver_id])->with('success', 'Driver Added successfully');
    }

    public function registerDriver($id=null){

        $carBrands = CarBrand::all();
        $states = State::all();

        return view('driver-register.index',['id'=>$id, 'carBrands' => $carBrands, 'states'=>$states]);

    }

    public function paymentPlans($id = null){

        return view('driver-register.payment-plan',['id'=>$id]);

    }

    public function newDriversRequest(){

        $newDrivers = User::role('Driver')->with('carDetails')->where('status','not_approved')->get();

        return view('admin.driver.new-request',compact('newDrivers'));

    }

    public function viewDriverRequest($id){
        
        $newDriver = User::role('Driver')->with('carDetails')->where('driver_id',$id)->first();
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();
        return view('admin.driver.view-request',compact('newDriver','carBrands','carModels'));

    }

    public function updateDriverStatus(Request $request, $id){

        $driverStatus = User::where('driver_id',$id)->update([
            "status" => $request->driver_status
        ]);
        //Sent email to user account approved

        return redirect()->route('view-request',['id'=>$id])->with('success', 'Driver status updated successfully');
    }


}
