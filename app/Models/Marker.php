<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = ['vehicle_code', 'message', 'x', 'y'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_code', 'code');
    }
}