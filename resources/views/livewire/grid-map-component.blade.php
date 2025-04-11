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
<div class="relative w-full overflow-x-auto">
    {{-- Kontainer fixed ukuran sesuai gridmap.png --}}
    <div class="relative" style="width: 4689px; height: 1993px;">
        {{-- Gambar sebagai background --}}
        <img src="{{ asset('img/index/gripmap.png') }}" 
             class="absolute top-0 left-0 w-full h-full z-0" 
             alt="Grid Map" />

        {{-- Overlay Grid --}}
        @foreach ($rows as $i => $row)
            @foreach ($cols as $j => $col)
                @php
                    $gridId = $row . $col;
                    $cellWidth = 4689 / 29;
                    $cellHeight = 1993 / 14;
                    $left = ($j - 1) * $cellWidth;
                    $top = $i * $cellHeight;
                    $bg = $grids[$gridId]['color'] ?? 'transparent';
                @endphp
                <div 
                    wire:click="selectGrid('{{ $gridId }}')"
                    title="{{ $gridId }}"
                    class="absolute border border-yellow-500 text-xs text-center cursor-pointer z-10"
                    style="
                        top: {{ $top }}px;
                        left: {{ $left }}px;
                        width: {{ $cellWidth }}px;
                        height: {{ $cellHeight }}px;
                        background-color: {{ $selectedGridId === $gridId ? '#f87171' : $bg }};
                    ">
                </div>
            @endforeach
        @endforeach
    </div>

    {{-- Modal Input --}}
    @if ($selectedGridId)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Atur Grid {{ $selectedGridId }}</h2>

                <div class="mb-2">
                    <label>Kendaraan:</label>
                    <select wire:model="selectedVehicle" class="w-full border p-1">
                        <option value="">Pilih Kendaraan</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label>Pesan:</label>
                    <textarea wire:model="message" class="w-full border p-1" rows="3"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button wire:click="cancel" class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>
                    <button wire:click="saveGrid" class="px-3 py-1 bg-red-500 text-white rounded">Simpan</button>
                </div>
            </div>
        </div>
    @endif
</div>



