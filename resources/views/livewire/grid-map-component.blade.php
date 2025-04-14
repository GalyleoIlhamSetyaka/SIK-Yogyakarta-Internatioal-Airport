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
<div class="container mx-auto p-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Vehicle Tracking Map</h1>
        <div class="flex items-center gap-2">
            <select wire:model="selectedVehicle" class="border rounded p-1">
                <option value="">-- Pilih Kendaraan --</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->nama }} ({{ $vehicle->code }})</option>
                @endforeach
            </select>
            <button wire:click="assignVehicle({{ $selectedVehicle }})" 
                    class="bg-blue-500 text-white px-3 py-1 rounded">
                Assign
            </button>
        </div>
    </div>

    <!-- Map Container -->
    <div class="flex gap-8">
        <!-- Grid Overlay -->
        <div class="relative" style="width: {{ $mapWidth }}px; height: {{ $mapHeight }}px;">
            <!-- Background Image -->
            <img src="{{ asset($mapImage) }}" 
                 alt="Grid Map" 
                 class="absolute top-0 left-0 w-full h-full object-cover">

            <!-- Grid System -->
            <div class="absolute top-0 left-0 w-full h-full">
                <!-- Column Numbers (1-29) -->
                <div class="flex absolute top-0 left-0 w-full bg-white bg-opacity-80">
                    <div class="w-8"></div>
                    @for($i = 1; $i <= $cols; $i++)
                        <div class="text-xs text-center" style="width: {{ $cellWidth }}px;">{{ $i }}</div>
                    @endfor
                </div>

                <!-- Rows (A-N) & Cells -->
                @for($row = 1; $row <= $rows; $row++)
                    <!-- Row Label (A, B, C...) -->
                    <div class="absolute left-0 font-bold text-center bg-white bg-opacity-80"
                         style="top: {{ 20 + ($row-1)*$cellHeight }}px; width: 30px;">
                        {{ chr(64 + $row) }}
                    </div>

                    <!-- Grid Cells -->
                    @for($col = 1; $col <= $cols; $col++)
                        @php
                            $gridId = chr(64 + $row) . $col;
                            $grid = $grids[$gridId] ?? null;
                            $hasVehicle = $grid && $grid->vehicle;
                        @endphp
                        <div wire:click="selectCell({{ $col }}, {{ $row }})"
                             class="absolute border border-gray-200 cursor-pointer hover:bg-white hover:bg-opacity-30 transition-all
                                    {{ $hasVehicle ? 'bg-' . $grid->color . '-500 bg-opacity-70' : '' }}
                                    {{ $selectedCell && $selectedCell->grid_id === $gridId ? 'ring-2 ring-blue-500' : '' }}"
                             style="width: {{ $cellWidth }}px;
                                    height: {{ $cellHeight }}px;
                                    left: {{ 30 + ($col-1)*$cellWidth }}px;
                                    top: {{ 20 + ($row-1)*$cellHeight }}px;">
                            @if($hasVehicle)
                                <div class="w-full h-full flex items-center justify-center text-white font-bold">
                                    {{ $grid->vehicle->code }}
                                </div>
                            @endif
                        </div>
                    @endfor
                @endfor
            </div>
        </div>

        <!-- Vehicle Info Panel -->
        @if($showVehicleInfo && $selectedVehicle)
            <div class="w-64 bg-white p-4 rounded-lg shadow-md">
                <h3 class="font-bold text-lg mb-2">Vehicle Info</h3>
                <img src="{{ asset('storage/vehicles/' . $selectedVehicle->image) }}" 
                     alt="{{ $selectedVehicle->nama }}" 
                     class="w-full h-auto mb-2">
                <p><strong>Nama:</strong> {{ $selectedVehicle->nama }}</p>
                <p><strong>Kode:</strong> {{ $selectedVehicle->code }}</p>
                <p><strong>Posisi:</strong> {{ $selectedCell->grid_id }}</p>
                <button wire:click="removeAssignment" 
                        class="mt-2 w-full bg-red-500 text-white py-1 rounded">
                    Hapus
                </button>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .grid-cell {
        box-sizing: border-box;
    }
    .bg-red-500 { background-color: #f56565; }
    .bg-blue-500 { background-color: #4299e1; }
    .bg-green-500 { background-color: #48bb78; }
</style>
@endpush


