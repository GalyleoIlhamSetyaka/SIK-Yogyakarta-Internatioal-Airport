<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Biarkan use statement ini

class Marker extends Model
{
    use HasFactory;

    protected $fillable = [
        'koordinat_x',
        'koordinat_y',
        'vehicle_id',
        'message',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}