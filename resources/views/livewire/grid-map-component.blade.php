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
<div class="relative">
    <img src="{{ asset('img/index/gripmap.png') }}" alt="Grid Map" class="w-full h-auto">

    @foreach($gridCells as $cell)
        <div
            wire:click="selectCell({{ $cell->id }})"
            class="absolute border"
            style="
                top: {{ $cell->y }}px;
                left: {{ $cell->x }}px;
                width: {{ $cell->width }}px;
                height: {{ $cell->height }}px;
                background-color: {{ $cell->color ?? 'transparent' }};
            "
        >
            {{ $cell->name }}
        </div>
    @endforeach

    @if($selectedCell)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-4 rounded">
                <h2>Edit Grid Cell</h2>
                <input type="text" wire:model="name" placeholder="Name" class="border p-1">
                <input type="text" wire:model="color" placeholder="Color" class="border p-1">
                <textarea wire:model="message" placeholder="Message" class="border p-1"></textarea>
                <button wire:click="save" class="bg-blue-500 text-white px-4 py-2">Save</button>
            </div>
        </div>
    @endif
</div>



