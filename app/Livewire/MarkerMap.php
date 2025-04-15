<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Marker;
use App\Models\Vehicle;

class MarkerMap extends Component
{
    public $markers;
    public $vehicles;
    public $selectedVehicle;
    public $message;
    public $tempX;
    public $tempY;

    protected $rules = [
        'selectedVehicle' => 'required|exists:vehicles,code',
        'message' => 'required|min:5|max:255',
        'tempX' => 'required|numeric|between:0,1200', // Sesuaikan dengan ukuran gambar
        'tempY' => 'required|numeric|between:0,800'
    ];

    protected $messages = [
        'selectedVehicle.required' => 'Pilih kendaraan terlebih dahulu',
        'message.required' => 'Pesan harus diisi',
    ];

    public function mount()
    {
        $this->vehicles = Vehicle::all();
        $this->loadMarkers();
    }

    public function loadMarkers()
    {
        $this->markers = Marker::with('vehicle')->get();
    }

    public function addMarker()
    {
        $this->validate();
        
        // Debugging: Log input values
        \Log::debug('Attempting to save:', [
            'x' => $this->tempX,
            'y' => $this->tempY,
            'vehicle' => $this->selectedVehicle,
            'message' => $this->message
        ]);
    
        try {
            $marker = Marker::create([
                'x' => $this->tempX,
                'y' => $this->tempY,
                'vehicle_code' => $this->selectedVehicle,
                'message' => $this->message,
            ]);
    
            // Force refresh markers
            $this->markers = Marker::with('vehicle')->get()->toArray();
            
            // Debugging: Check new marker
            \Log::debug('New marker created:', $marker->toArray());
    
        } catch (\Exception $e) {
            \Log::error('Save failed: '.$e->getMessage());
        }
    }

    public function deleteMarker($id)
    {
        Marker::findOrFail($id)->delete();
        $this->loadMarkers();
    }

    public function updatedTempX($value)
    {
        $this->tempX = (int)$value;
    }

    public function updatedTempY($value)
    {
        $this->tempY = (int)$value;
    }

    public function render()
    {
        return view('livewire.marker-map')
            ->layout('layouts.app');
    }
}