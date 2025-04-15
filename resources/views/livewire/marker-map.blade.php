@livewireStyles
@vite('resources/css/app.css')
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

    <li class="nav-item">
      <a class="nav-link text-dark" href="{{ url('/home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-dark" href="home/profile">{{ __('Profile') }}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="/grid-map">{{ __('Grid Map') }}</a>
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
<div x-data="{ selectedCoords: null, hoveredMarker: null, showSidebarForm: false, selectedVehicle: null }" class="map-container">
    <!-- Main Map Area -->
    <div class="relative bg-gray-100 p-4 rounded-lg shadow-lg flex-1">
        <div class="relative" wire:ignore>
            <img 
                src="{{ asset('img/index/gripmap.png') }}" 
                class="max-w-full h-auto cursor-crosshair"
                id="mapImage"
                @click="
                    const rect = $event.target.getBoundingClientRect();
                    selectedCoords = {
                        x: $event.clientX - rect.left,
                        y: $event.clientY - rect.top
                    };
                    showSidebarForm = true;
                "
            >
            
            <!-- Markers dengan Material Icons -->
            @foreach($markers as $marker)
                <div 
                    class="absolute cursor-pointer transition-transform"
                    style="left: {{ $marker->x }}px; top: {{ $marker->y }}px;"
                    wire:key="marker-{{ $marker->id }}"
                    @mouseover="hoveredMarker = {{ $marker->id }}"
                    @mouseleave="hoveredMarker = null"
                >
                    <div class="text-red-600 material-icons-outlined text-4xl drop-shadow-lg">
                        @php
                            $icon = match($marker->vehicle->code) {
                                'A1', 'A2', 'A3' => 'local_hospital',
                                'F1', 'F2', 'F3' => 'fire_truck',
                                'P' => 'local_police',
                                'T' => 'directions_car',
                                'NT' => 'local_shipping',
                                default => 'place'
                            };
                        @endphp
                        {{ $icon }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar w-96">
        <!-- Add Marker Form -->
        <div x-show="showSidebarForm" class="bg-white p-4 rounded-lg border mb-6">
            <h3 class="text-lg font-bold mb-4">Tambah Marker Baru</h3>
            <form wire:submit.prevent="addMarker">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Koordinat</label>
                    <input 
                        type="text" 
                        value="X: @{{ selectedCoords?.x.toFixed(0) }}, Y: @{{ selectedCoords?.y.toFixed(0) }}" 
                        class="w-full p-2 border rounded bg-gray-50 cursor-not-allowed"
                        disabled
                    >
                </div>
    <!-- Input Hidden untuk Koordinat -->
    <input type="hidden" wire:model="tempX">
    <input type="hidden" wire:model="tempY">
    
    @error('selectedVehicle') 
        <div class="alert alert-danger mb-2">{{ $message }}</div>
    @enderror
    
    @error('message') 
        <div class="alert alert-danger mb-2">{{ $message }}</div>
    @enderror


        <!-- Vehicle Selection -->
        <div class="mb-4">
            <h3 class="text-xl font-bold mb-2 text-gray-700">Pilih Kendaraan</h3>
            <select 
                wire:model="selectedVehicle"
                class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
                <option value="">-- Pilih Kendaraan --</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->code }}">
                        {{ $vehicle->code }} - {{ $vehicle->name }}
                    </option>
                @endforeach
            </select>
        </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Pesan</label>
                    <textarea
                        wire:model="message"
                        class="w-full p-2 border rounded"
                        rows="3"
                        placeholder="Masukkan pesan informasi..."
                    ></textarea>
                    @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button 
                        type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded hover:bg-gray-200"
                        @click="showSidebarForm = false"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Simpan Marker
                    </button>
                </div>
            </form>
        </div>

        <!-- Marker Information -->
        <div class="pt-4">
            <h3 class="text-lg font-bold mb-4">Informasi Marker</h3>
            <template x-if="hoveredMarker">
                <div class="p-4 bg-gray-50 rounded-lg">
                    @foreach($markers as $marker)
                        <div x-show="hoveredMarker === {{ $marker->id }}">
                            <p class="font-medium">
                                {{ $marker->vehicle->code }} - {{ $marker->vehicle->name }}
                            </p>
                            <p class="text-sm mt-2">Koordinat: X:{{ $marker->x }}, Y:{{ $marker->y }}</p>
                            <p class="text-sm">Pesan: {{ $marker->message }}</p>
                            <button 
                                class="mt-2 text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                wire:click="deleteMarker({{ $marker->id }})"
                            >
                                Hapus Marker
                            </button>
                        </div>
                    @endforeach
                </div>
            </template>
        </div>
    </div>
</div>