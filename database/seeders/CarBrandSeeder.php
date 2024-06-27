<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarBrand;
class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carBrand = CarBrand::create([
            'brand_name' => 'Chevrolet',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Honda',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Maruti Suzuki',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Hyundai',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Tata',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Mahindra',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Kia',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Toyota',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Ford',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Renault',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Volkswagen',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Skoda',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'Nissan',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
        $carBrand = CarBrand::create([
            'brand_name' => 'MG',
            'brand_image' => 'uploads/brands/1719390207.png'
        ]);
    }
}
