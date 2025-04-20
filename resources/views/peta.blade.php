@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('navbar_home')
  @guest
    @if (Route::has('login'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
    @endif

    @if (Route::has('register'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
      </li>
    @endif
  @else

    @if($user->customClaims['admin'])
        <li class="nav-item">
        <a class="nav-link text-dark" href="/home/admin">{{ __('Admin') }}</a>
        </li>
    @endif

    <li class="nav-item">
      <a class="nav-link text-dark" href="/home/profile">{{ __('Profile') }}</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link text-dark" href="/marker-map">{{ __('Grid Map') }}</a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-dark" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </li>
</div>
</li>
@endguest
@endsection
@section('content')
<div class="bg-gray-100 py-8">
    <div class="mx-auto max-w-[1800px] px-4">
        <h1 class="text-2xl font-bold mb-4">GRIDMAP YOGYAKARTA INTERNATIONAL AIRPORT</h1>

        <!-- Flex Container -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Map Section -->
            <div class="w-full lg:w-2/3">
                <div id="map-container1">
                    @foreach ($markers as $marker)
                            <div class="marker"
                                style="left: {{ $marker->koordinat_x }}px; top: {{ $marker->koordinat_y }}px;"
                                data-id="{{ $marker->id }}"
                                data-message="{{ $marker->message }}"
                                data-vehicle="{{ $marker->vehicle->name ?? 'Tidak diketahui' }}">

                                <!-- Pop-up -->
                                <div class="popup absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-white text-sm text-gray-800 border px-3 py-2 rounded shadow-lg z-50 w-52 hidden">
                                    <div class="font-semibold mb-1">{{ $marker->vehicle->name ?? 'Tidak diketahui' }}</div>
                                    <div class="text-xs mb-2">{{ $marker->message }}</div>
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
    </div>
</div>
    <script>

    </script>
@endsection
