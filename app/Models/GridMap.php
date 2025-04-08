<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GridMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'grid_id',
        'color',
        'message',
    ];

    public $timestamps = false;
}
