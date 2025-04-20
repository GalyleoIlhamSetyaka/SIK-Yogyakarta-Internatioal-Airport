<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function simpanMarker(Request $request)
    {
        $validatedData = $request->validate([
            'koordinat_x' => 'required|integer',
            'koordinat_y' => 'required|integer',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'message' => 'nullable|string|max:255',
        ]);

        $marker = Marker::create($validatedData);

        return response()->json(['success' => true, 'message' => 'Marker berhasil disimpan', 'marker' => $marker->load('vehicle')]);
    }

    public function destroy($id)
    {
        $marker = Marker::findOrFail($id);
        $marker->delete();

        return response()->json(['message' => 'Marker deleted']);
    }
}