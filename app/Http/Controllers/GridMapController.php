<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GridMap;
use App\Models\Vehicle;

class GridMapController extends Controller
{
    public function index()
    {
        $grids = GridMap::all()->keyBy('grid_id');
        $vehicles = Vehicle::all();
    
        return view('grid-map', [
            'grids' => $grids,
            'vehicles' => $vehicles,
            'selectedGrid' => null // Tambahkan ini untuk mencegah undefined variable
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'grid_id' => 'required|string',
            'color' => 'required|string',
            'message' => 'nullable|string',
        ]);

        GridMap::updateOrCreate(
            ['grid_id' => $request->grid_id],
            [
                'color' => $request->color,
                'message' => $request->message,
            ]
        );

        return redirect()->back()->with('success', 'Grid updated.');
    }
}
