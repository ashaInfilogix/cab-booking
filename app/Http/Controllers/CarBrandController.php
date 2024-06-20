<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use File;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carBrands = CarBrand::all();
        return view('admin.car-brand.index',compact('carBrands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car-brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name'  => 'required',
            'brand_logo'  => 'required'
        ]);
        if($request->hasFile('brand_logo')){

            $file = $request->file('brand_logo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands/'), $filename);

        }        

        CarBrand::create([
            'brand_name'  => $request->brand_name,
            'brand_image' => 'uploads/brands/'.$filename, 
        ]);
        return redirect()->route('car-brand.index')->with('success', 'Car brand saved successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(CarBrand $carBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarBrand $carBrand)
    {
        $brandDetails = CarBrand::find($carBrand->id);
        return view('admin.car-brand.edit',compact('brandDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarBrand $carBrand)
    {
        $brand = CarBrand::find($carBrand->id);

        if($request->hasfile('brand_logo')){

            $file = $request->file('brand_logo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands/'), $filename);

            $brand->brand_name = $request->brand_name;
            $brand->brand_image = 'uploads/brands/'. $filename;
            $brand->save();

        }else{

            $brand->brand_name = $request->brand_name; 

        } 

        $brand->save();

        return redirect()->route('car-brand.index')->with('success', 'Brand update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarBrand $carBrand)
    {
        $delete = CarBrand::find($carBrand->id);
        $delete->delete();
        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully.'
        ]);
    }
}
