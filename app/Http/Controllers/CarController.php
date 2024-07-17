<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;

use App\Models\Driver;
use App\Models\User;
use App\Models\BankDetail;
use App\Models\State;
use App\Models\CarDetail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();
        if($auth->hasRole('Driver')){

            $carsList = User::with('carsList')->where('driver_id',$auth->driver_id)->where('registration_status','completed')->get();
            return view('admin.cars.index',compact('carsList'));
        }
        $carsList = User::role('Driver')->with('carsList')->where('registration_status','completed')->get();
        return view('admin.cars.index',compact('carsList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = User::role('Driver')->get();
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();
        return view('admin.cars.create',compact('carBrands','carModels','drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $driver_id = $request->driver_id;
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
        return redirect()->route('cars.index')->with('success', 'Car Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $newDriver = CarDetail::where('registration_number',$id)->first();
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();
        
        return view('admin.cars.edit',compact('newDriver','carBrands','carModels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $carDetails = CarDetail::where('registration_number', $id)->first(); 

        $carDetails->registration_number = $request->registration_number;
        $carDetails->brand_id = $request->brand_id;
        $carDetails->model_id = $request->model_id;
        $carDetails->chassis_number = $request->chassis_number;
        $carDetails->engine_number = $request->engine_number;
        $carDetails->locations = $request->locations;
        

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
                $newCarImages = array_merge(json_decode($carDetails->car_images),$files);
                $carDetails->car_images = json_encode($newCarImages);
            }
        }

        $carDetails->save();
        return redirect()->route('cars.edit',$id)->with('success', 'Car details updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $delete = Car::find($car->id);
        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => 'Car deleted successfully.'
        ]);
    }
    public function getCarModels(Request $request)
    {
        $carModels = CarModel::where('brand_id', $request->model_id)->get();
        $options ='<option value=""> ---Select Model--- </option>';
        foreach($carModels as $model)
        {
            $options .= '<option value="'.  $model->id .'">'. $model->model_name	 .'</option>';
        }

        return response()->json([
            'options' => $options
        ]);
    }
    public function deleteCarImage(Request $request){
       
        $delete = CarDetail::where('registration_number',$request->car_id)->first();
        $imagesURL = [];
        foreach(json_decode($delete->car_images) as $image_url ){
            if($image_url != $request->image_path){
                $imagesURL[] = $image_url;
            }
        }
        $delete->car_images = json_encode($imagesURL);
        $delete->save();
        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.'
        ]);
    }
}
