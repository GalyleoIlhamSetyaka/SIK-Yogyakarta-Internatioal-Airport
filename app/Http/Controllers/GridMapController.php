<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Google\Cloud\Firestore\FirestoreClient;

class GridMapController extends Controller
{
    protected $firestore;

    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'keyFilePath' => base_path('resources/credentials/firebase_credentials.json'), // path ke credential-mu
            'projectId' => 'your-project-id', // GANTI dengan ID project Firebase kamu
        ]);
    }

    public function index()
    {
        $snapshot = $this->firestore->collection('kendaraan')->documents();
        $vehicleData = [];

        foreach ($snapshot as $doc) {
            $data = $doc->data();
            $vehicleData[$data['location']] = $data;
        }

        return view('grid-map', compact('vehicleData'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required',
            'vehicle_id' => 'required',
            'vehicle_type' => 'required',
        ]);

        $this->firestore->collection('kendaraan')->document($validated['location'])->set([
            'location' => $validated['location'],
            'vehicle_id' => $validated['vehicle_id'],
            'vehicle_type' => $validated['vehicle_type'],
        ]);

        return redirect()->route('grid.map')->with('success', 'Data kendaraan berhasil disimpan ke Firestore.');
    }
}
