<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GridCell;

class GridMapComponent  extends Component
{
    public $gridCells;
    public $selectedCell;
    public $name;
    public $color;
    public $message;

    public function mount()
    {
        $this->gridCells = GridCell::all();
    }

    public function selectCell($id)
    {
        $this->selectedCell = GridCell::find($id);
        $this->name = $this->selectedCell->name;
        $this->color = $this->selectedCell->color;
        $this->message = $this->selectedCell->message;
    }

    public function save()
    {
        $this->selectedCell->update([
            'name' => $this->name,
            'color' => $this->color,
            'message' => $this->message,
        ]);

        $this->gridCells = GridCell::all();
    }

    public function render()
    {
        return view('livewire.grid-map-component')
        ->layout('component.layouts.app');

    }
}
