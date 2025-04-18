<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Marker;
use App\Models\Vehicle;

class PetaKustom extends Component
{
    public $markers = [];
    public $vehicles = [];
    public $selectedVehicleId;
    public $message;
    public $newMarkerX;
    public $newMarkerY;
    public $showForm = false;

    public function mount()
    {
        $this->markers = Marker::with('vehicle')->get()->toArray();
        $this->vehicles = Vehicle::all();
    }

    public function tambahMarker($x, $y)
    {
        $this->newMarkerX = $x;
        $this->newMarkerY = $y;
        $this->showForm = true;
        $this->selectedVehicleId = null; // Reset pilihan kendaraan
        $this->message = ''; // Reset pesan
    }

    public function simpanMarker()
    {
        $this->validate([
            'newMarkerX' => 'required|integer',
            'newMarkerY' => 'required|integer',
            'selectedVehicleId' => 'nullable|exists:vehicles,id',
            'message' => 'nullable|string|max:255',
        ]);

        $marker = new Marker();
        $marker->koordinat_x = $this->newMarkerX;
        $marker->koordinat_y = $this->newMarkerY;
        $marker->vehicle_id = $this->selectedVehicleId;
        $marker->message = $this->message;
        $marker->save();

        $this->markers = Marker::with('vehicle')->get()->toArray();
        $this->resetForm();
    }

    public function batal()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->showForm = false;
        $this->newMarkerX = null;
        $this->newMarkerY = null;
        $this->selectedVehicleId = null;
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.peta-kustom')
        ->layout('component.layouts.app');
    }
}