<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GridMap;
use App\Models\Vehicle;

class GridMapController extends Controller
{
    public function index()
    {
        // Ambil semua data grid dari database dan ubah menjadi keyed array
        $grids = GridMap::all()->keyBy('grid_id');
        $vehicles = Vehicle::all();
    
        return view('grid-map', compact('grids', 'vehicles'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'grid_id' => 'required|string',
            'color' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        // Simpan atau update data grid
        GridMap::updateOrCreate(
            ['grid_id' => $request->grid_id],
            [
                'color' => $request->color ?? 'transparent',
                'message' => $request->message ?? '',
            ]
        );

        return redirect()->back()->with('success', 'Grid berhasil diperbarui.');
    }
}
