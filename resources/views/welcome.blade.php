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
            <div class="hidden md:flex space-x-4 ">
                <a href="/" class="text-white text-lg ">Home</a>
                <a href="/about" class="text-white text-lg">About</a>
                <a href="/contact" class="text-white text-lg">Contact</a>
                <a href="/login" class="text-white text-lg">Login</a>
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
    <section class="">
        <div class="h-screen flex items-center relative overflow-hidden">
        <div class="absolute w-full h-full bg-[url('{{ asset('img/index/YIA.png') }}')] bg-cover bg-center blur-sm"></div>
            <div class="container mx-auto flex justify-between items-center relative z-10">
                <div class="w-full">
                <h1 class="text-9xl font-bold text-blue-500">Welcome to Yogyakarta International Airport</h1>
                <p class="text-3xl text-white mt-4">The airport is located in the heart of Yogyakarta, Indonesia. It is the third-busiest airport in the country based on the aircraft movements and passenger movements.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="bg-white py-12 h-screen" id="about">
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

    <section class="bg-gray-100 h-screen flex flex-col justify-center items-center" id="grid-map-system">
  <div class="container mx-auto px-4">
   <div class="text-center mb-8 md:mb-12 lg:mb-16">
    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-blue-700 mb-4">Sistem Informasi Posisi Kendaraan dengan Grid Map</h2>
    <p class="text-gray-600 text-lg md:text-xl">Visualisasikan dan analisis posisi kendaraan Anda dengan representasi lingkungan berbasis grid yang sederhana dan efisien.</p>
   </div>

   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">
    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center text-center">
     <h3 class="text-xl md:text-2xl font-semibold text-blue-500 mb-2">Representasi Grid yang Efisien</h3>
     <p class="text-gray-700 text-sm md:text-md">Lingkungan operasional dibagi menjadi sel-sel grid terstruktur, memungkinkan visualisasi posisi kendaraan yang jelas dan mudah dipahami.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center text-center">
     <h3 class="text-xl md:text-2xl font-semibold text-blue-500 mb-2">Pemantauan Real-time</h3>
     <p class="text-gray-700 text-sm md:text-md">Lacak posisi kendaraan Anda secara langsung melalui antarmuka grid map yang dinamis. Informasi posisi diperbarui secara berkala.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center text-center">
     <h3 class="text-xl md:text-2xl font-semibold text-blue-500 mb-2">Analisis Kepadatan</h3>
     <p class="text-gray-700 text-sm md:text-md">Identifikasi area dengan konsentrasi kendaraan tinggi untuk pengambilan keputusan yang lebih baik dalam manajemen operasional.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center text-center">
     <h3 class="text-xl md:text-2xl font-semibold text-blue-500 mb-2">Integrasi Data Posisi</h3>
     <p class="text-gray-700 text-sm md:text-md">Mendukung berbagai sumber data posisi seperti GPS, sensor lokal, dan sistem telematika untuk akurasi yang optimal.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center text-center">
     <h3 class="text-xl md:text-2xl font-semibold text-blue-500 mb-2">Visualisasi yang Informatif</h3>
     <p class="text-gray-700 text-sm md:text-md">Tampilan grid yang intuitif dengan indikator warna dan informasi tambahan saat berinteraksi dengan sel kendaraan.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center text-center">
     <h3 class="text-xl md:text-2xl font-semibold text-blue-500 mb-2">Potensi Aplikasi Luas</h3>
     <p class="text-gray-700 text-sm md:text-md">Cocok untuk manajemen armada, pemantauan keamanan, parkir pintar, analisis lalu lintas, dan berbagai aplikasi berbasis lokasi lainnya.</p>
    </div>
   </div>

 </section>

 <footer class="bg-blue-500 py-8">
  <div class="container mx-auto px-4 flex justify-center items-center">
   <div class="flex items-center mr-16">
    <img src="{{ asset('img/index/TAG.png') }}" alt="Logo Footer" class="h-12 mr-6">
   </div>
   <div class="text-white text-left text-sm">
    <p>Palihan, Temon</p>
    <p>Kulon Progo, DI Yogyakarta</p>
    <p>Indonesia - 56554</p>
    <p>Telp: (0274) 6488072 | Fax: (0274) 4606001</p>
    <p>cs172@ap1.co.id</p>
   </div>
  </div>
 </footer>
</body>
</html>