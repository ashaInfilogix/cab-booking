<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function brands()
    {
        return $this->hasOne(CarBrand::class,'id','brand_id');
    }
    public function models()
    {
        return $this->hasOne(CarModel::class,'id','model_id');
    }
}
