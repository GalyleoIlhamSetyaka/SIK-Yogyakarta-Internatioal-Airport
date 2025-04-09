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
<div class="relative w-full">
    {{-- Gambar Grid Map --}}
    <img src="{{ asset('public/img/kendaraan/gripmap.png') }}" alt="Grid Map" class="w-full h-auto">

    {{-- Overlay grid --}}
    @foreach ($grids as $gridId => $grid)
        <div
            class="absolute cursor-pointer border"
            style="
                top: {{ $grid['top'] }}px;
                left: {{ $grid['left'] }}px;
                width: {{ $grid['width'] }}px;
                height: {{ $grid['height'] }}px;
                background-color: {{ $grid['color'] ?? 'transparent' }};
            "
            wire:click="selectGrid('{{ $gridId }}')"
            title="{{ $grid['message'] ?? 'Kosong' }}"
        >
        </div>
    @endforeach

    {{-- Form untuk edit grid --}}
    @if ($modalVisible && $selectedGrid)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
                <h2 class="text-lg font-semibold mb-4">Edit Grid: {{ $selectedGrid }}</h2>

                <div class="mb-4">
                    <label for="color" class="block text-sm font-medium">Warna</label>
                    <input type="color" id="color" wire:model="color" class="mt-1 block w-full border rounded">
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium">Pesan</label>
                    <input type="text" id="message" wire:model="message" class="mt-1 block w-full border rounded">
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="saveGrid" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Simpan
                    </button>
                    <button wire:click="$set('modalVisible', false)" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
