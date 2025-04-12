<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GridMap;
use App\Models\Vehicle;

class GridMapComponent extends Component
{
    public $rows, $cols;
    public $grids = [];
    public $selectedGridId, $selectedVehicle, $message;

    public function mount()
    {
        $this->rows = range('A', 'N');
        $this->cols = range(1, 29);

        $this->grids = GridMap::all()->keyBy('grid_id')->map(function ($grid) {
            return [
                'color' => $grid->color,
                'message' => $grid->message,
                'vehicle_id' => $grid->vehicle_id,
            ];
        })->toArray();
    }

    public function selectGrid($gridId)
    {
        $this->selectedGridId = $gridId;
        $grid = GridMap::where('grid_id', $gridId)->first();

        $this->selectedVehicle = $grid->vehicle_id ?? null;
        $this->message = $grid->message ?? '';
    }

    public function saveGrid()
    {
        GridMap::updateOrCreate(
            ['grid_id' => $this->selectedGridId],
            [
                'vehicle_id' => $this->selectedVehicle,
                'message' => $this->message,
                'color' => '#f87171'
            ]
        );

        $this->reset(['selectedGridId', 'selectedVehicle', 'message']);
        $this->mount(); // refresh data
    }

    public function cancel()
    {
        $this->reset(['selectedGridId', 'selectedVehicle', 'message']);
    }

    public function render()
    {
        return view('livewire.grid-map-component', [
            'vehicles' => Vehicle::all()
        ])->layout('component.layouts.app');
    }
}
