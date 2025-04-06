<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yogyakarta Airport</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="{{ asset('img/index/TAG.png') }}" alt="Logo" class="h-14 w-18 mr-2">
            </a>
            <div class="hidden md:flex space-x-4">
                <a href="/" class="text-white">Home</a>
                <a href="/about" class="text-white">About</a>
                <a href="/contact" class="text-white">Contact</a>
                <a href="/login" class="text-white">Login</a>
                </div>
            <div class="md:hidden">
                <button class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
    <section class="pt-16">
        <div class="h-screen flex items-center">
            <div class="container mx-auto flex justify-between items-center">
                <div class="w-1/2">
                    <div class="absolute top-0 left-0 w-full h-full bg-[url('{{ asset('img/index/YIA.png') }}')] bg-cover bg-center" style="filter: blur(5px);"></div>
                    <h1 class="text-6xl font-bold text-blue-500 relative z-10">Welcome to Yogyakarta International Airport</h1>
                    <p class="text-xl text-white relative z-10">The airport is located in the heart of Yogyakarta, Indonesia. It is the third-busiest airport in the country based on the aircraft movements and passenger movements.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="bg-white py-12" id="about">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-12 gap-8">
        <div class="col-span-12 md:col-span-6 relative">
                <img src="{{ asset('img/index/Plane2.png') }}" alt="Pesawat" class="w-full">
            </div>
            <div class="col-span-12 md:col-span-6">
                <p class="text-blue-700 text-lg">
                    Bandar Udara Internasional Yogyakarta (IATA: YIA, ICAO: WAHI) adalah sebuah Bandar Udara Internasional yang terletak 45 kilometer dari Kota Yogyakarta tepatnya di Kapanewon Temon, Kulon Progo. YIA menggantikan Bandar Udara Internasional Adisucipto (JOG) yang dinilai sudah tidak mampu lagi menampung kapasitas penumpang dan pesawat. Bandar YIA melayani penerbangan domestik ke beberapa kota-kota di Indonesia serta penerbangan internasional ke Kuala Lumpur dan Singapura. Per 29 April 2024, bandar udara ini merupakan satu-satunya bandar udara internasional untuk Daerah Istimewa Yogyakarta dan seluruh Provinsi Jawa Tengah.
                </p>
            </div>

        </div>
    </div>
    </section>

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
</body>
</html>