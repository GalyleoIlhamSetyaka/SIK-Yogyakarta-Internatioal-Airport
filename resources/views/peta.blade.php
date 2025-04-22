@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('navbar_gridmap')
    @guest
        @if (Route::has('login'))
            <li><a href="{{ route('login') }}" class="text-gray-700 hover:underline">Login</a></li>
        @endif

        @if (Route::has('register'))
            <li><a href="{{ route('register') }}" class="text-gray-700 hover:underline">Register</a></li>
        @endif
    @else
        @php $user = Auth::user(); @endphp

        @if(isset($user->customClaims['admin']) && $user->customClaims['admin'])
            <li><a href="/home/admin" class="text-gray-700 hover:underline">Admin</a></li>
        @endif

        <li><a href="/home/profile" class="text-gray-700 hover:underline">Profile</a></li>
        <li><a href="/marker-map" class="text-gray-700 hover:underline">Grid Map</a></li>
        <li>
            <a href="{{ route('logout') }}" class="text-gray-700 hover:underline"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </li>
    @endguest
@endsection
@section('content')
<div class="bg-white">
    <div class="mx-auto max-w-[1800px] px-4" id="grid-map">
        <h1 class="text-2xl font-bold mb-4 ">GRIDMAP YOGYAKARTA INTERNATIONAL AIRPORT</h1>

        <!-- Flex Container -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Map Section -->
            <div class="w-full lg:w-2/3">
                <div id="map-container1">
                @foreach ($markers as $marker)
                <div class="marker text-white flex items-center justify-center text-xs font-bold"
                    style="left: {{ $marker->koordinat_x }}px; top: {{ $marker->koordinat_y }}px;"
                    data-id="{{ $marker->id }}"
                    data-message="{{ $marker->message }}"
                    data-vehicle="{{ $marker->vehicle->name ?? 'Tidak diketahui' }}">

                    {{ $marker->vehicle->code ?? '' }}

                    <div class="popup absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-white text-sm text-gray-800 border px-3 py-2 rounded shadow-lg z-50 w-52 hidden">
                        <!-- Gambar Kendaraan -->
                        @php
                            $kodeKendaraan = $marker->vehicle->code ?? '';
                            $gambarPath = "img/kendaraan/{$kodeKendaraan}.png"; // Sesuaikan ekstensi file
                        @endphp
                        
                        <div class="mb-2">
                            @if(file_exists(public_path($gambarPath)))
                                <img src="{{ asset($gambarPath) }}" 
                                    alt="{{ $marker->vehicle->name }}" 
                                    class="w-full h-24 object-cover rounded">
                            @else
                                <div class="bg-gray-100 h-24 flex items-center justify-center text-gray-400 text-xs rounded">
                                    Gambar tidak ditemukan
                                </div>
                            @endif
                        </div>

                        <div class="font-bold mb-1 ">{{ $marker->vehicle->name ?? 'Tidak diketahui' }}</div>
                        <div class="text-xs mb-2 font-semibold ">{{ $marker->message }}</div>
                        <button class="delete-marker bg-red-500 text-white text-xs px-2 py-1 rounded" data-id="{{ $marker->id }}">
                            Hapus
                        </button>
                    </div>
                </div>
                @endforeach
                </div>
            </div>

            <!-- Form Section -->
            <div id="sidebar-container" class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold mb-4">Tambah Marker Baru</h2>

                <form id="marker-form" class="space-y-4">
                    @csrf
                    <input type="hidden" id="koordinat_x" name="koordinat_x">
                    <input type="hidden" id="koordinat_y" name="koordinat_y">

                    <div>
                        <label for="vehicle_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Kendaraan:</label>
                        <select id="vehicle_id" name="vehicle_id" class="w-full border rounded py-2 px-3">
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Pesan:</label>
                        <textarea id="message" name="message" rows="3" class="w-full border rounded py-2 px-3"></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan Marker</button>
                        <button type="button" id="cancel-button" class="bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400">Batal</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Card Grid Kendaraan -->
        <div class="mt-8">
            <h2 class="text-3xl font-bold mb-8 text-center ">Daftar Kendaraan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4"> 
                @php
                    $path = public_path('img/kendaraan');
                    $files = file_exists($path) ? scandir($path) : [];
                    $imageExtensions = ['png', 'jpg', 'jpeg', 'webp'];
                @endphp

                @foreach($files as $file)
                    @if(!in_array($file, ['.', '..']))
                        @php
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                            $code = pathinfo($file, PATHINFO_FILENAME);
                        @endphp
                        
                        @if(in_array(strtolower($extension), $imageExtensions))
                            <div class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <img src="{{ asset('img/kendaraan/'.$file) }}" 
                                    alt="{{ $code }}" 
                                    class="w-full h-full object-cover">
                                
                                <div class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-white text-xl font-bold text-lg">{{ $code }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach

                @if(empty($files))
                    <div class="col-span-full text-center py-8 text-gray-500">
                        Tidak ada gambar kendaraan tersedia
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
    <script>

    </script>
@endsection
