<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    // ✅ Menampilkan halaman peta
    public function index()
    {
        // Jika ingin mengirim data marker ke view juga, kamu bisa load semua marker
        $markers = Marker::with('vehicle')->get();
        return view('peta', compact('vehicles', 'markers'));
    }

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