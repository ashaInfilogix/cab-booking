<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('brands')->with('models')->get(); 
        return view('admin.cars.index',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carBrands = CarBrand::all();
        return view('admin.cars.add',compact('carBrands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $images = $request->images;
        if ($images) {
            $files = [];
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $file)
                {
                    $filename = uniqid().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('uploads/car-images/'), $filename);
     
                    $files[]  = 'uploads/car-images/'. $filename;

                }
            }
        }
       

        $car = Car::create([
            'brand_id' => $request->brand_id,
            'model_id' => $request->model_id,
            'year' => $request->year,
            'color' => $request->color,
            'VIN' => $request->vin,
            'engine_number' => $request->engine_number,
            'chassis_number' => $request->chassis_number,
            'mileage' => $request->mileage,
            'vehicle_type' => $request->vehicle_type,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'doors' => $request->doors,
            'seats' => $request->seats,
            'condition' => $request->condition,
            'description' => $request->description,
            'image_urls' => json_encode( $files),
        ]);
        return redirect()->route('cars.index')->with('success', 'Car saved successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $cars = Car::find($car->id);
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();

        return view('admin.cars.view',compact('carBrands','carModels','cars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $cars = Car::find($car->id);
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();
        return view('admin.cars.edit',compact('carBrands','carModels','cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $images = $request->images;
        if ($images) {
            $newImages = [];
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $file)
                {
                    $filename = uniqid().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('uploads/car-images/'), $filename);
     
                    $newImages[]  = 'uploads/car-images/'. $filename;

                }
            }
            $imagesUpdate = Car::find($car->id);
            $currentImages = json_decode($imagesUpdate->image_urls);
            $bothImages = array_merge($currentImages,$newImages);
            $imagesUpdate->image_urls = json_encode($bothImages);
            $imagesUpdate->save();
        }


        $car = Car::where('id',$car->id)->update([
            'brand_id' => $request->brand_id,
            'model_id' => $request->model_id,
            'year' => $request->year,
            'color' => $request->color,
            'VIN' => $request->vin,
            'engine_number' => $request->engine_number,
            'chassis_number' => $request->chassis_number,
            'mileage' => $request->mileage,
            'vehicle_type' => $request->vehicle_type,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'doors' => $request->doors,
            'seats' => $request->seats,
            'condition' => $request->condition,
            'description' => $request->description,
        ]);
        return redirect()->route('cars.index')->with('success', 'Car saved successfully');

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
       
        $delete = Car::find($request->carId);
        $imagesURL = [];
        foreach(json_decode($delete->image_urls) as $image_url ){
            if($image_url != $request->imagePath){
                $imagesURL[] = $image_url;
            }
        }
        $delete->image_urls = json_encode($imagesURL);
        $delete->save();
        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.'
        ]);
    }
}
