<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'image',
    ];

    public function markers(): HasMany
    {
        return $this->hasMany(Marker::class);
    }
}