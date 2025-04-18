@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/css/peta.css'])
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
<div class="bg-gray-100">
    <div class=" mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Peta Kustom Anda</h1>

        <div id="map-container1" class="mb-4">
            <div id="grid-overlay"></div>
            {{-- Optional Grid Overlay --}}
            @foreach ($markers as $marker)
            <div class="marker" style="left: {{ $marker->koordinat_x }}px; top: {{ $marker->koordinat_y }}px;"></div>
            @endforeach
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-lg font-semibold mb-4">Tambah Marker Baru</h2>

            <form id="marker-form" class="space-y-4">
                @csrf
                <input type="hidden" id="koordinat_x" name="koordinat_x">
                <input type="hidden" id="koordinat_y" name="koordinat_y">

                <div>
                    <label for="vehicle_id" class="block text-gray-700 text-sm font-bold mb-2">
                        Pilih Kendaraan:
                    </label>
                    <select id="vehicle_id" name="vehicle_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">
                        Pesan:
                    </label>
                    <textarea id="message" name="message" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Marker
                    </button>
                    <button type="button" id="cancel-button"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const mapContainer = document.getElementById('map-container1');
        const markerForm = document.getElementById('marker-form');
        const koordinatXInput = document.getElementById('koordinat_x');
        const koordinatYInput = document.getElementById('koordinat_y');
        const markerFormContainer = document.getElementById('marker-form-container');
        const cancelButton = document.getElementById('cancel-button');

        let tempMarker = null;  //  Variabel untuk menyimpan referensi ke marker sementara

        mapContainer.addEventListener('click', function(event) {
            const rect = mapContainer.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            // Hapus marker sebelumnya jika ada
            if (tempMarker) {
                tempMarker.remove();
            }

            // Buat elemen marker baru
            tempMarker = document.createElement('div');
            tempMarker.classList.add('marker');
            tempMarker.style.left = `${x}px`;
            tempMarker.style.top = `${y}px`;
            mapContainer.appendChild(tempMarker);

            // Isi nilai input form
            koordinatXInput.value = Math.round(x);
            koordinatYInput.value = Math.round(y);


        });

        cancelButton.addEventListener('click', function() {
            markerForm.reset();
            if (tempMarker) {
                tempMarker.remove();  //  Hapus marker
                tempMarker = null;    //  Reset referensi
            }
        });

        markerForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(markerForm);

            fetch('{{ route('peta.simpan') }}', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Marker saved successfully!', data);
                        // Update UI (e.g., add marker without reload)
                    } else {
                        console.error('Error saving marker:', data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            markerForm.reset();
        });
    </script>
</div>
@endsection
