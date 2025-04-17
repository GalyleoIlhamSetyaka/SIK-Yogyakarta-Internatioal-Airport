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
<div class="space-y-4">
    <div class="relative w-full h-[600px] bg-cover bg-[url('{{ asset('images/peta_anda.png') }}')] border border-gray-300 cursor-crosshair"
         wire:click.prevent="tambahMarker($event.offsetX, $event.offsetY)"
         id="map-container">
        @foreach ($markers as $marker)
            <div class="absolute w-5 h-5 rounded-full cursor-pointer"
                 style="left: {{ $marker['koordinat_x'] }}px; top: {{ $marker['koordinat_y'] }}px; background-color: {{ $marker['vehicle'] ? 'blue' : 'red' }};"
                 title="{{ $marker['vehicle'] ? $marker['vehicle']['name'] : 'Marker' }} {{ $marker['message'] ? ' - ' . $marker['message'] : '' }}">
            </div>
        @endforeach

        @if ($newMarkerX !== null && $newMarkerY !== null)
            <div class="absolute w-5 h-5 bg-green-500 rounded-full transform translate-x-[-50%] translate-y-[-50%] pointer-events-none"
                 style="left: {{ $newMarkerX }}px; top: {{ $newMarkerY }}px;">
            </div>
        @endif
    </div>

    <div class="p-4 border border-gray-300 rounded">
        <h2 class="text-lg font-semibold mb-4">Form Tambah Marker</h2>

        @if ($showForm)
            <form wire:submit.prevent="simpanMarker" class="space-y-4">
                <div>
                    <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Pilih Kendaraan:</label>
                    <select wire:model="selectedVehicleId" id="vehicle_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->code }})</option>
                        @endforeach
                    </select>
                    @error('selectedVehicleId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Pesan:</label>
                    <textarea wire:model="message" id="message" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="batal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Simpan</button>
                </div>
            </form>
        @else
            <p class="text-gray-500">Klik pada peta untuk menambahkan marker.</p>
        @endif
    </div>

    @push('scripts')
    <script>
    document.addEventListener('livewire:initialized', () => {
        const mapContainer = document.getElementById('map-container');

        mapContainer.addEventListener('click', (event) => {
            Livewire.dispatch('tambahMarker', event.offsetX, event.offsetY);
        });
    });
    </script>
    @endpush
</div>
