<?php

namespace App\Livewire;

use App\Models\Marker;
use App\Models\Vehicle;
use Livewire\Component;

class MarkerMap extends Component
{
    public $markers;
    public $vehicles;
    public $selectedVehicle;
    public $message;
    public $showModal = false;
    public $tempX = 0;
    public $tempY = 0;
    
    protected $rules = [
        'selectedVehicle' => 'required|exists:vehicles,code',
        'message' => 'required|min:5|max:255',
    ];

    public function mount()
    {
        $this->vehicles = Vehicle::all();
        $this->loadMarkers();
    }

    public function loadMarkers()
    {
        $this->markers = Marker::with('vehicle')->get()->toArray();
    }

    public function openModal($x, $y)
    {
        $this->tempX = $x;
        $this->tempY = $y;
        $this->showModal = true;
    }

    public function addMarker()
    {
        $this->validate();
        
        Marker::create([
            'x' => $this->tempX,
            'y' => $this->tempY,
            'vehicle_code' => $this->selectedVehicle,
            'message' => $this->message,
        ]);
        
        $this->reset(['message', 'selectedVehicle', 'showModal']);
        $this->loadMarkers();
    }

    public function updateMarkerPosition($id, $x, $y)
    {
        Marker::findOrFail($id)->update([
            'x' => max(0, min($x, 1200)),
            'y' => max(0, min($y, 800))
        ]);
        
        $this->loadMarkers();
    }

    public function deleteMarker($id)
    {
        Marker::findOrFail($id)->delete();
        $this->loadMarkers();
    }

    public function render()
    {
        return view('livewire.marker-map')
            ->layout('layouts.app');
    }
}