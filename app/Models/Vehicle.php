<?php

// app/Models/Vehicle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['nama', 'code', 'image'];
}
