<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Marker;
use App\Models\Vehicle;

class MarkerMap extends Component
{
    public $markers = [];
    public $vehicles = [];

    public $newMarkerX = null;
    public $newMarkerY = null;

    public $selectedVehicleId = '';
    public $message = '';
    public $showForm = false;
    public $editingMarkerId = null;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->markers = Marker::with('vehicle')->get()->toArray();
        $this->vehicles = Vehicle::all();
    }

    public function tambahMarker($x, $y)
    {
        $this->newMarkerX = $x;
        $this->newMarkerY = $y;
        $this->showForm = true;
        $this->message = '';
        $this->selectedVehicleId = '';
        $this->editingMarkerId = null;
    }

    public function simpanMarker()
    {
        $this->validate([
            'selectedVehicleId' => 'required|exists:vehicles,id',
            'message' => 'nullable|string|max:255'
        ]);

        Marker::create([
            'vehicle_id' => $this->selectedVehicleId,
            'koordinat_x' => $this->newMarkerX,
            'koordinat_y' => $this->newMarkerY,
            'message' => $this->message,
        ]);

        $this->resetForm();
        $this->loadData();
    }

    public function editMarker($id)
    {
        $marker = Marker::findOrFail($id);
        $this->editingMarkerId = $id;
        $this->newMarkerX = $marker->koordinat_x;
        $this->newMarkerY = $marker->koordinat_y;
        $this->selectedVehicleId = $marker->vehicle_id;
        $this->message = $marker->message;
        $this->showForm = true;
    }

    public function updateMarker()
    {
        $this->validate([
            'selectedVehicleId' => 'required|exists:vehicles,id',
            'message' => 'nullable|string|max:255'
        ]);

        Marker::find($this->editingMarkerId)?->update([
            'vehicle_id' => $this->selectedVehicleId,
            'message' => $this->message,
        ]);

        $this->resetForm();
        $this->loadData();
    }

    public function deleteMarker($id)
    {
        Marker::find($id)?->delete();
        $this->loadData();
    }

    public function batal()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->newMarkerX = null;
        $this->newMarkerY = null;
        $this->selectedVehicleId = '';
        $this->message = '';
        $this->showForm = false;
        $this->editingMarkerId = null;
    }

    public function render()
    {
        return view('livewire.marker-map')
        ->layout('component.layouts.app');

    }
}
