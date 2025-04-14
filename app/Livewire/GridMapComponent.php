<?php

// app/Livewire/VehicleGridMap.php
namespace App\Livewire;
use App\Models\GridMap;
use App\Models\Vehicle;
use Livewire\Component;

class GridMapComponent extends Component {
    // Konfigurasi Grid
    public $cols = 29;
    public $rows = 14;
    public $cellWidth = 44.14;  // 1280px / 29 kolom
    public $cellHeight = 51.43;  // 720px / 14 baris
    public $mapWidth = 1280;
    public $mapHeight = 720;
    public $mapImage = 'img/index/gripmap.png';

    // State
    public $selectedCell = null;
    public $selectedVehicle = null;
    public $vehicles = [];
    public $grids = [];
    public $showVehicleInfo = false;

    public function mount() {
        $this->loadData();
    }

    public function loadData() {
        $this->grids = GridMap::with('vehicle')->get()->keyBy('grid_id');
        $this->vehicles = Vehicle::with('grid')->get();
    }

    public function selectCell($col, $row) {
        $gridId = $this->getGridId($col, $row);
        $this->selectedCell = $this->grids[$gridId] ?? null;
        
        if ($this->selectedCell && $this->selectedCell->vehicle) {
            $this->selectedVehicle = $this->selectedCell->vehicle;
            $this->showVehicleInfo = true;
        } else {
            $this->selectedVehicle = null;
            $this->showVehicleInfo = false;
        }
    }

    public function assignVehicle($vehicleId) {
        if (!$this->selectedCell) return;

        // Hapus assignment sebelumnya
        GridMap::where('vehicle_id', $vehicleId)->update(['vehicle_id' => null]);

        // Assign ke grid terpilih
        $gridId = $this->getGridId($this->selectedCell->x, $this->selectedCell->y);
        GridMap::updateOrCreate(
            ['grid_id' => $gridId],
            ['vehicle_id' => $vehicleId, 'x' => $this->selectedCell->x, 'y' => $this->selectedCell->y]
        );

        $this->loadData();
    }

    public function removeAssignment() {
        if (!$this->selectedCell) return;
        $this->selectedCell->update(['vehicle_id' => null]);
        $this->loadData();
        $this->selectedVehicle = null;
        $this->showVehicleInfo = false;
    }

    private function getGridId($col, $row) {
        $letters = range('A', 'Z');
        return $letters[$row - 1] . $col;
    }

    public function render() {
        return view('livewire.grid-map-component')
            ->layout('layouts.app');
    }
}