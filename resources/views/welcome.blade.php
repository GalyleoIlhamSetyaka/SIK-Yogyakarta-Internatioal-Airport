<!DOCTYPE html>
<html lang="en">
<head>
@vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yogyakarta Airport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,500;1,500&display=swap" rel="stylesheet">

</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="{{ asset('img/index/TAG.png') }}" alt="Logo" class="h-14 w-18 mr-2">
            </a>
            <div class="hidden md:flex space-x-4 ">
                <a href="/" class="text-white text-lg ">Home</a>
                <a href="#grid-map-system" class="text-white text-lg">About</a>
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
        <div class="h-screen flex items-center justify-center relative overflow-hidden">
            <div class="absolute w-full h-full bg-[url('{{ asset('img/index/YIA.png') }}')] bg-cover bg-center blur-sm"></div>
            <div class="container mx-auto flex justify-center items-center relative z-10">
                <div class="text-center">
                    <h1 class="text-9xl font-bold text-blue-500">Welcome to Simulasi Tabletop Bandar Udara Internasional Yogyakarta</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="h-screen bg-white" id="about">
    <div class="h-full container mx-auto px-4 flex items-center justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-12 h-full">

            <div class="flex items-center h-full">
                <p class="text-blue-500 text-justify text-xl leading-relaxed md:text-2xl">
                Tabletop exercise merupakan salah satu bentuk latihan non-teknis yang penting bagi personel PKP-PK  
                di Bandar Udara Internasional Yogyakarta dalam rangka meningkatkan kesiapsiagaan menghadapi situasi darurat penerbangan. 
                Latihan ini dilakukan dalam bentuk diskusi terstruktur berdasarkan skenario insiden kecelakaan pesawat atau kebakaran di area bandara, dengan tujuan untuk mengevaluasi pemahaman prosedur operasi, koordinasi antar unit, 
                serta pengambilan keputusan secara cepat dan tepat. 
                <br></br>
                Melalui tabletop exercise, personel PKP-PK dapat mengidentifikasi potensi hambatan operasional, menguji kejelasan jalur komunikasi, serta memperkuat sinergi antara tim pemadam, ATC, keamanan, dan pihak eksternal seperti ambulans atau SAR. 
                Latihan ini juga menjadi sarana untuk memperbarui SOP berdasarkan pengalaman simulasi, 
                sehingga meningkatkan efisiensi dan efektivitas penanganan insiden nyata di lapangan.
                </p>
            </div>

            <div class="relative flex items-center justify-center h-full">
                <img src="{{ asset('img/index/Plane2.png') }}"
                     alt="Pesawat"
                     class="relative z-10 w-full max-w-md animate-fly" />
            </div>

        </div>
    </div>
    </section>


    <section class="bg-gray-100 h-screen flex flex-col justify-center items-center" id="grid-map-system">
        <div class="container mx-auto px-4">
        <div class="text-center mb-8 md:mb-12 lg:mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-blue-700 mb-4">Sistem Informasi Posisi Kendaraan dengan Grid Map</h2>
            <p class="text-gray-600 text-lg md:text-xl">Visualisasikan dan analisis posisi kendaraan dengan representasi lingkungan berbasis grid yang sederhana dan efisien.</p>
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
    <div class="text-white text-left text-md">
        <p>Palihan, Temon</p>
        <p>Kulon Progo, DI Yogyakarta</p>
        <p>Indonesia - 56554</p>
        <p>Telp: (0274) 6488072 | Fax: (0274) 4606001</p>
        <p>cs172@ap1.co.id</p>
    </div>
    </div>
 </footer>
</body>

<style>
@keyframes flyUpDown {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.animate-fly {
    animation: flyUpDown 3s ease-in-out infinite;
}
</style>
</html>