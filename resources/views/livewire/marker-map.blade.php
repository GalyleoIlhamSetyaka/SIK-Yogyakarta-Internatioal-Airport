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
<div x-data="{ showModal: false, hoveredMarker: null, tempX: 0, tempY: 0 }" class="map-container">
    <!-- Main Map Area -->
    <div class="relative bg-gray-100 p-4 rounded-lg shadow-lg">
        <div class="relative" wire:ignore>
            <img 
                src="{{ asset('img/index/gripmap.png') }}" 
                class="max-w-full h-auto cursor-crosshair"
                id="mapImage"
                @click="
                    const rect = $event.target.getBoundingClientRect();
                    tempX = $event.clientX - rect.left;
                    tempY = $event.clientY - rect.top;
                    showModal = true;
                "
            >
            
            <!-- Grid Overlay -->
            <div class="image-grid"></div>
            
            <!-- Markers -->
            @foreach($markers as $marker)
                <div 
                    x-data="{
                        x: {{ $marker->x }},
                        y: {{ $marker->y }},
                        dragging: false,
                        init() {
                            this.$watch('dragging', value => {
                                if (!value) {
                                    $wire.updateMarker({{ $marker->id }}, this.x, this.y);
                                }
                            });
                        }
                    }"
                    class="absolute w-6 h-6 cursor-move transition-transform"
                    style="left: {{ $marker->x }}px; top: {{ $marker->y }}px;"
                    wire:key="marker-{{ $marker->id }}"
                    @mousedown="dragging = true"
                    @mouseup="dragging = false"
                    @mousemove.away="
                        if (dragging) {
                            const rect = document.getElementById('mapImage').getBoundingClientRect();
                            x = $event.clientX - rect.left - 12;
                            y = $event.clientY - rect.top - 12;
                        }
                    "
                    x-bind:style="`left: ${x}px; top: ${y}px`"
                    @mouseover="hoveredMarker = {{ $marker->id }}"
                    @mouseleave="hoveredMarker = null"
                >
                    <img 
                        src="{{ asset('img/kendaraan/'.$marker->vehicle->image) }}" 
                        class="w-full h-full rounded-full border-2 border-white shadow-lg"
                        title="{{ $marker->vehicle->name }}"
                    >
                    
                    <!-- Popup Info -->
                    <div x-show="hoveredMarker === {{ $marker->id }}" 
                         class="absolute bottom-full left-1/2 transform -translate-x-1/2 -translate-y-2 bg-white p-3 rounded-lg shadow-md border border-gray-200 min-w-[220px]">
                        <div class="text-sm font-semibold text-gray-800">
                            {{ $marker->vehicle->name }} ({{ $marker->vehicle->code }})
                        </div>
                        <div class="text-xs text-gray-600 mt-2">
                            {{ $marker->message }}
                        </div>
                        <div class="mt-3 flex justify-end space-x-2">
                            <button 
                                class="text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                @click="$wire.deleteMarker({{ $marker->id }})"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="mb-6">
            <h3 class="text-xl font-bold mb-4 text-gray-700">Pilih Kendaraan</h3>
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

        <!-- Information Panel -->
        <div class="border-t pt-4">
            <h3 class="text-xl font-bold mb-4 text-gray-700">Informasi Marker</h3>
            <template x-if="hoveredMarker">
                <div class="space-y-3">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-700">
                            Koordinat: 
                            <span x-text="`X: ${$wire.markers.find(m => m.id === hoveredMarker).x}, Y: ${$wire.markers.find(m => m.id === hoveredMarker).y}`"></span>
                        </p>
                        <p class="text-sm text-gray-600 mt-1" x-text="'Pesan: ' + $wire.markers.find(m => m.id === hoveredMarker).message"></p>
                    </div>
                </div>
            </template>
        </div>

    </div>

    <!-- Add Marker Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md" @click.away="showModal = false">
            <h3 class="text-lg font-semibold mb-4">Tambah Marker Baru</h3>
            <form wire:submit.prevent="addMarker(tempX, tempY)">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                    <input 
                        type="text" 
                        value="X: @{{ tempX }}, Y: @{{ tempY }}" 
                        class="w-full p-2 border rounded cursor-not-allowed bg-gray-50"
                        disabled
                    >
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                    <textarea
                        wire:model="message"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        rows="3"
                        placeholder="Masukkan pesan informasi..."
                    ></textarea>
                    @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button 
                        type="button"
                        class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
                        @click="showModal = false"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700"
                    >
                        Simpan Marker
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>