<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@livewireStyles
@vite('resources/css/app.css')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Informasi Kendaraan</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body style="min-height:90vh;">
@livewireScripts
    <div id="app">
        <nav class="bg-blue-500 p-4 sticky top-0 z-50">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold text-white ">
                    <a href="/" class="hover:text-blue-500">Sistem Informasi Kendaraan Yogyakarta Internasional Airport</a>
                </div>
                <ul class="hidden md:flex space-x-4 text-white">
                    @guest  
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}" class=" hover:text-blue-500">Login</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}" class=" hover:text-blue-500">Register</a>
                            </li>
                        @endif
                    @else
                        @php
                            $user = Auth::user();
                        @endphp

                        @if(isset($user->customClaims['admin']) && $user->customClaims['admin'])
                            <li>
                                <a href="/home/admin" class=" hover:text-blue-500">Admin</a>
                            </li>
                        @endif

                        <li>
                            <a href="/home/profile" class=" hover:text-blue-500">Profile</a>
                        </li>

                        <li>
                            <a href="/peta" class=" hover:text-blue-500">Grid Map</a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}"
                            class="text-red-500 hover:text-red-700"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
            <div class="md:hidden">
                    <button class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
            </div>
        </nav>
        <main class="py-4">

        {{-- Ini untuk support halaman Blade biasa --}}
        @yield('content')
        </main>
    </div>

    <footer class="bg-blue-500 py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div>
                <img src="{{ asset('img/index/TAG.png') }}" alt="Logo Footer" class="h-10">
            </div>
            <div class="text-sm text-white text-align-center">
                <p>Andalan, Temon</p>
                <p>Kulon Progo, Yogyakarta</p>
                <p>Indonesia - 56554</p>
                <p>Telp: (0274) 6488072 | Fax: (0274) 4606001</p>
                <p>cs172@ap1.co.id</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
