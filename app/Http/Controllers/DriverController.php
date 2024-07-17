<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Driver;
use App\Models\User;
use App\Models\BankDetail;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\State;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\CarDetail;
use App\Models\RatingComment;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Mail\InformEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        if($auth->hasRole('Driver')){
            $newDrivers = User::role('Driver')->with('carDetails')->where('driver_id',$auth->driver_id)->where('registration_status','completed')->get();
            return view('admin.driver.index',compact('newDrivers'));
        }

        $newDrivers = User::role('Driver')->with('carDetails')->where('registration_status','completed')->get();

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
        $alreadyExist = User::where('email','=',$request->email)->first();
        if($alreadyExist){
            if($alreadyExist->registration_status == 'completed'){

                return redirect()->route('driver.register')->with('error', 'This '.$request->email.' email already registered');
            
            }else{

                return redirect()->route('driver.register',base64_encode($alreadyExist->driver_id))->with('success', 'Driver Added successfully');
            
            }
        }else{
            $driver = User::create([
                'name' => $request->name,
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
            $driver->registration_status = 'completed';
            $driver->save();
            // Send email to inform customer
            $data = array('title' => 'Your first step successfully completed' , 'message' => 'Please proceed next step if you are missing <a href="'.route('driver.register',base64_encode($driver_id)).'">Click here</a>');

            $email = Mail::to($request->email)->send(new InformEmail($data));

            return redirect()->route('driver.register',base64_encode($driver_id))->with('success', 'Driver Added successfully');
    
        }
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
        $states = State::all();

        foreach($newDriver->carsList as $carsList){
            $carBrand = CarBrand::find($carsList->brand_id);
            $carModel = CarModel::find($carsList->model_id);
            $carsList->brand_name = $carBrand->brand_name;
            $carsList->model_name = $carModel->model_name;
        }

        return view('admin.driver.edit',compact('newDriver','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = explode(" ",$request->full_name);
        
        $driver = User::where('driver_id',$id)->update([
            'name' => $name[0],
            'last_name' => $name[1],
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'dob' => $request->dob,
            'aadhar_number' => $request->aadhar_number,
            'license_number' => $request->license_number,
            'address' => $request->address,
            'state' => $request->state,
            'password' => Hash::make($request->password),
            'status' => $request->driver_status
        ]);
        if($request->password){
            $driver->password = Hash::make($request->password);
        }

        if($request->hasfile('profile_pic')){

            $file = $request->file('profile_pic');
            $filename = $id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers-image/'), $filename);

            $driver = User::where('driver_id',$id)->first();
            $driver->profile_pic = 'uploads/drivers-image/'.$filename;
            $driver->save();
        }

        return redirect()->route('drivers.edit',$id)->with('success', 'Driver Details Updated Successfully');
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
        
        // Send Email to inform
        $data = array('title' => 'Your first step successfully completed' , 'message' => 'Hi '.$request->name.' '.$request->last_name.', Please proceed next step if you are missing <a href="'.route('driver.register',base64_encode($driver_id)).'">Click here</a>');
        $email = Mail::to($request->email)->send(new InformEmail($data));

        return redirect()->route('payment.plan',['id'=>$request->driver_id])->with('success', 'Driver Added successfully');
    }

    public function registerDriver($id=null){

        $carBrands = CarBrand::all();
        $states = State::all();

        return view('driver-register.index',['id'=>$id, 'carBrands' => $carBrands, 'states'=>$states]);

    }

    public function paymentPlans($id = null){

        $plans = Plan::where('status','active')->get();
        return view('driver-register.payment-plan',['id'=>$id,'plans'=>$plans]);

    }

    public function newDriversRequest(){

        $newDrivers = User::role('Driver')->with('carDetails')->where('status','not_approved')->where('registration_status','completed')->get();

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
        $data = array('title' => 'Congratulations Your Driver Profile Approved' , 'message' => 'Hi '.$driverStatus->name.' '.$driverStatus->last_name.', Your driver profile approved successfully, Now customer can find you on our site');
        $email = Mail::to($request->email)->send(new InformEmail($data));


        return redirect()->route('view-request',['id'=>$id])->with('success', 'Driver status updated successfully');
    }

    public function makePayment(Request $request, $id, $driver_id, $price){
        $driver_id = base64_decode($driver_id);
        $plan = Plan::find($id);

        $subscription_id = "SUB-".str_shuffle('A7B8C3D4E5');
        $trasnaction_id = "TR-".str_shuffle('a7b8c3d4e5f6g7h');

        $driver = User::where('driver_id','=', $driver_id)->first();
        $startDate = Carbon::now();
        $startDate->toDateString();
        $endDate = $startDate->addYear();

        if ($driver) {

            $subscription = Subscription::create([
                "subscripton_id" => $subscription_id,
                "driver_id" => $driver_id,
                "plan" => $plan->amount,
                "start_date" => $startDate,
                "end_date" => $endDate,
                "status" => "active"
            ]);

            $payment = Payment::create([
                "trasnaction_id" => $trasnaction_id,
                "subscripton_id" => $subscription_id,
                "amount" => $plan->amount,
                "status" => 'completed',
            ]);

            //Sent email to user account approved
            $data = array('title' => 'Your Payment Successfully Completed' , 'message' => 'Your Subscription ID : '.$subscription_id.' Trasnaction ID : '.$trasnaction_id);
            $email = Mail::to($request->email)->send(new InformEmail($data));

            return redirect()->route('payment.plan',$driver_id)->with('message','Your payment successfully done');

        } else {

            $payment = Payment::create([
                "trasnaction_id" => $trasnaction_id,
                "subscripton_id" => $subscription_id,
                "amount" => $plan->amount,
                "status" => 'failed',
            ]);
            //Sent email to user account approved
            $data = array('title' => 'Your Payment Status Failed' , 'message' => 'Your Subscription ID : '.$subscription_id.' Trasnaction ID : '.$trasnaction_id);
            $email = Mail::to($request->email)->send(new InformEmail($data));

            return redirect()->route('payment.plan',$driver_id)->with('message','Driver record not available please contact with supprt team');
        
        }
        
    }

    public function driverInfo($driver_id){
        
        $driverInfo = User::with('carsList')->where('driver_id',$driver_id)->first();
        foreach($driverInfo->carsList as $carsList){
            $carBrand = CarBrand::find($carsList->brand_id);
            $carModel = CarModel::find($carsList->model_id);
            $carsList->brand_name = $carBrand->brand_name;
            $carsList->model_name = $carModel->model_name;
        }
        DB::table('profile_clicks')->insert([
            'driver_id' => $driver_id,
            'IP_address' => request()->ip(),
            'created_at'=> now(),
            'updated_at' => now()
        ]);

        $ratings = RatingComment::where('driver_id',$driver_id)->get();
        $sumRating = RatingComment::where('driver_id',$driver_id)->sum('rating');
        $totalRecord = RatingComment::where('driver_id',$driver_id)->count();

        if ($totalRecord > 0) {
            $totalRating = number_format(($sumRating) / $totalRecord, 2);
        } else {
            $totalRating = 0; 
        }

        return view('driver-register.driver-info',compact('driverInfo','ratings','totalRating'));
    }

    public function searchFilter(Request $request){
        $query = $request->input('query');
        $results = User::select('users.*', 'car_details.locations', 'car_models.model_name')
            ->join('car_details', 'users.driver_id', '=', 'car_details.driver_id')
            ->join('car_models', 'car_details.model_id', '=', 'car_models.id')
            ->where('users.status', '=', 'active')
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('users.last_name', 'like', '%'.$query.'%')
            ->orWhere('car_details.locations', 'like', '%'.$query.'%')
            ->orWhere('car_models.model_name', 'like', '%'.$query.'%')
            ->get();
        

            $searchList = '';
            foreach ($results as $result) {
                $sumRating = RatingComment::where('driver_id', $result->driver_id)->sum('rating');
                $totalRecord = RatingComment::where('driver_id', $result->driver_id)->count();
            
                if ($totalRecord > 0) {
                    $result->totalRating = number_format(($sumRating) / $totalRecord, 2);
                } else {
                    $result->totalRating = 0; 
                }
                $searchList .= '<a href="'.route('driver.info',$result->driver_id).'"><div class="image-name">
                        <img class="searc-img" src="'.asset($result->profile_pic).'">
                        <p>'.$result->name.' '.$result->last_name.'<br>';

                            for ($i = 1; $i <= 5; $i++){
                                if($i <= $result->totalRating){
                                    $searchList .= '<i class="fa fa-star" aria-hidden="true" style="color:#fdb100"></i>';
                                }else{
                                    $searchList .= '<i class="fa fa-star" aria-hidden="true"></i>';
                                }
                            } 

                $searchList .= '<br>
                            <i class="fa fa-car" aria-hidden="true"></i> : '.$result->model_name.'
                            <br>
                            <i class="fa fa-globe" aria-hidden="true"></i> : '.$result->locations.'
                        </p>
                    </div></a>';

            }

        return $searchList;


    }


}
