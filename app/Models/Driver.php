<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Driver extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected static function booted()
    {
        static::creating(function ($driver) {
            $driver->driver_id = Uuid::uuid4()->toString(); // Generate a UUID for driver_id
        });
    }
    public function carDetails(){
        return $this->hasOne(Car::class,'VIN','vehicle_number');
    }
    public function bankDetails(){
        return $this->hasOne(BankDetail::class,'driver_id');
    }
}
