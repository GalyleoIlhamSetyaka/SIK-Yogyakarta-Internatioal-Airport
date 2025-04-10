<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GridMap;
use App\Models\Vehicle;

class GridMapComponent extends Component
{
    public $grids = [];
    public $vehicles = [];
    public $selectedGrid = null;
    public $modalVisible = false;
    public $color = '#ffffff';
    public $message = '';

    public function mount()
    {
        $this->grids = GridMap::all()->keyBy('grid_id')->toArray();
        $this->vehicles = Vehicle::all();
    }

    public function selectGrid($gridId)
    {
        $this->selectedGrid = $gridId;
        $grid = GridMap::where('grid_id', $gridId)->first();
        $this->color = $grid->color ?? '#ffffff';
        $this->message = $grid->message ?? '';
        $this->modalVisible = true;
    }

    public function saveGrid()
    {
        GridMap::updateOrCreate(
            ['grid_id' => $this->selectedGrid],
            ['color' => $this->color, 'message' => $this->message]
        );

        $this->grids = GridMap::all()->keyBy('grid_id')->toArray();
        $this->modalVisible = false;
    }

    public function render()
    {
        return view('livewire.grid-map-component')
        ->layout('component.layouts.app');

    }
}
