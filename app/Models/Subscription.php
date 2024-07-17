<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getTransaction(){
        return $this->hasMany(Payment::class,'subscripton_id','subscripton_id');
    }
}
