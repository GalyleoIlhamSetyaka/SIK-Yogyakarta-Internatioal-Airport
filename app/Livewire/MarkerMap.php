<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Marker;

class MarkerMap extends Component
{
    public $vehicle;
    public $message;
    public $x, $y;
    public $showForm = false;

    public function save()
    {
        Marker::create([
            'vehicle' => $this->vehicle,
            'message' => $this->message,
            'x' => $this->x,
            'y' => $this->y,
        ]);

        $this->reset(['vehicle', 'message', 'x', 'y', 'showForm']);
    }

    public function render()
    {
        return view('livewire.marker-map', [
            'markers' => Marker::all(),
        ]);
    }
}
