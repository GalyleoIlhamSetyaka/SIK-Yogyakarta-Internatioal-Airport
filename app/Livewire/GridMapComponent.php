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
        $this->rows = range('A', 'N'); // 14 rows
        $this->cols = range(1, 29);    // 29 columns

        $this->grids = GridMap::all()
            ->keyBy('grid_id')
            ->map(fn ($grid) => [
                'color' => $grid->color,
                'message' => $grid->message,
                'vehicle_id' => $grid->vehicle_id
            ])->toArray();
    }

    public function selectGrid($gridId)
    {
        $this->selectedGridId = $gridId;
        $this->message = $this->grids[$gridId]['message'] ?? '';
        $this->selectedVehicle = $this->grids[$gridId]['vehicle_id'] ?? null;
    }

    public function saveGrid()
    {
        $color = '#ff0000';

        GridMap::updateOrCreate(
            ['grid_id' => $this->selectedGridId],
            [
                'color' => $color,
                'message' => $this->message,
                'vehicle_id' => $this->selectedVehicle
            ]
        );

        $this->grids[$this->selectedGridId] = [
            'color' => $color,
            'message' => $this->message,
            'vehicle_id' => $this->selectedVehicle
        ];

        $this->reset(['selectedGridId', 'selectedVehicle', 'message']);
    }

    public function cancel()
    {
        $this->reset(['selectedGridId', 'selectedVehicle', 'message']);
    }

    public function render()
    {
        return view('livewire.grid-map-component', [
            'vehicles' => Vehicle::all(),
        ])
        ->layout('component.layouts.app');
    }
}
