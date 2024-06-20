<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Models\CarBrand;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carModels = CarModel::with('brands')->get();
        return view('admin.car-model.index',compact('carModels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carBrands = CarBrand::all();
        return view('admin.car-model.add-model',compact('carBrands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $carModel =  new CarModel();
        $carModel->brand_id = $request->brand_id;
        $carModel->model_name = $request->model_name;
        $carModel->save();

        return redirect()->route('car-model.index')->with('success', 'Car Model saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarModel $carModel)
    {
        $carBrands = CarBrand::all();
        $cardModels = CarModel::find($carModel->id);
        return view('admin.car-model.edit',compact('cardModels','carBrands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $carModel)
    {
        $carModel = CarModel::find($carModel->id);
        $carModel->brand_id = $request->brand_id;
        $carModel->model_name = $request->model_name;
        $carModel->save();

        return redirect()->route('car-model.index')->with('success', 'Car Model updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {
        $delete = CarModel::find($carModel->id);
        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => 'Model deleted successfully.'
        ]);
    }
}
