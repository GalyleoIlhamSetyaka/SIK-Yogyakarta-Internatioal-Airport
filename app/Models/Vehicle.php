<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'image'];
    
    public function markers()
    {
        return $this->hasMany(Marker::class, 'vehicle_code', 'code');
    }
}