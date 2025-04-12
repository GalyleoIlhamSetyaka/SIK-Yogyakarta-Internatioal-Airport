<?php

// app/Models/GridMap.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GridMap extends Model
{
    protected $fillable = ['grid_id', 'color', 'message', 'vehicle_id'];
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
