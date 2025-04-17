
<head>
    <title>Peta Kustom</title>
    <style>
        #map-container {
            position: relative;
            width: 1500px; /* Sesuaikan dengan lebar gambar Anda */
            height: 800px; /* Sesuaikan dengan tinggi gambar Anda */
            background-image: url('{{ asset('img/index/gridmap.png') }}'); /* Ganti dengan path gambar Anda */
            background-size: cover;
            border: 1px solid #ccc;
        }

        .marker {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius: 50%;
            cursor: pointer;
            transform: translate(-50%, -50%); /* Agar titik tengah marker sesuai dengan posisi klik */
        }
    </style>
</head>
<body>
    <h1>Peta Kustom Anda</h1>
    <div id="map-container">
        @foreach ($markers as $marker)
            <div class="marker" style="left: {{ $marker->koordinat_x }}px; top: {{ $marker->koordinat_y }}px;"></div>
        @endforeach
    </div>

    <form id="marker-form" style="display: none;">
        @csrf
        <input type="hidden" id="koordinat_x" name="koordinat_x">
        <input type="hidden" id="koordinat_y" name="koordinat_y">
        <button type="submit">Simpan Marker</button>
    </form>

    <script>
        const mapContainer = document.getElementById('map-container');
        const markerForm = document.getElementById('marker-form');
        const koordinatXInput = document.getElementById('koordinat_x');
        const koordinatYInput = document.getElementById('koordinat_y');

        mapContainer.addEventListener('click', function(event) {
            const rect = mapContainer.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            // Buat elemen marker baru
            const newMarker = document.createElement('div');
            newMarker.classList.add('marker');
            newMarker.style.left = `${x}px`;
            newMarker.style.top = `${y}px`;
            mapContainer.appendChild(newMarker);

            // Isi nilai input form
            koordinatXInput.value = Math.round(x);
            koordinatYInput.value = Math.round(y);

            // Kirim data marker ke server menggunakan AJAX
            fetch('{{ route('peta.simpan') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ koordinat_x: Math.round(x), koordinat_y: Math.round(y) }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Marker berhasil disimpan.');
                    // Anda bisa menambahkan logika untuk memperbarui tampilan tanpa reload penuh
                } else {
                    console.error('Gagal menyimpan marker.');
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        });
    </script>
</body>
