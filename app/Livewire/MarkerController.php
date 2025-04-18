<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marker;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;

class MarkerController extends Controller
{
    public function index()
    {
        $markers = Marker::with('vehicle')->get();
        $vehicles = Vehicle::all();
        return view('peta-kustom', compact('markers', 'vehicles'), ['showForm' => false, 'newMarkerX' => null, 'newMarkerY' => null]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'koordinat_x' => 'required|integer',
            'koordinat_y' => 'required|integer',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'message' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        Marker::create($validator->validated());

        return response()->json(['success' => true, 'message' => 'Marker berhasil disimpan.'], 200);
    }

    public function getMarkers()
    {
        $markers = Marker::with('vehicle')->get();
        return response()->json($markers);
    }
}