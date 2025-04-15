<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = ['x', 'y','vehicle_code', 'message'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_code', 'code');
    }
}