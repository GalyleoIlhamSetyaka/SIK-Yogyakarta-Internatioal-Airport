<?php
// app/Http/Controllers/PetaKustomController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marker; // Asumsikan Anda memiliki model Marker

class PetaKustomController extends Controller
{
    public function index()
    {
        $markers = Marker::all(); // Ambil semua marker dari database
        return view('peta_kustom', compact('markers'));
    }

    public function simpanMarker(Request $request)
    {
        $marker = new Marker();
        $marker->koordinat_x = $request->input('koordinat_x');
        $marker->koordinat_y = $request->input('koordinat_y');
        // Anda bisa menambahkan kolom lain seperti deskripsi marker, dll.
        $marker->save();

        return response()->json(['success' => true]);
    }
}