import './bootstrap';
const mapContainer = document.getElementById('map-container1');
const markerForm = document.getElementById('marker-form');
const koordinatXInput = document.getElementById('koordinat_x');
const koordinatYInput = document.getElementById('koordinat_y');
const markerFormContainer = document.getElementById('marker-form-container');
const cancelButton = document.getElementById('cancel-button');

let tempMarker = null;  //  Variabel untuk menyimpan referensi ke marker sementara

mapContainer.addEventListener('click', function(event) {
    const rect = mapContainer.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    // Hapus marker sebelumnya jika ada
    if (tempMarker) {
        tempMarker.remove();
    }

    // Buat elemen marker baru
    tempMarker = document.createElement('div');
    tempMarker.classList.add('marker');
    tempMarker.style.left = `${x}px`;
    tempMarker.style.top = `${y}px`;
    mapContainer.appendChild(tempMarker);

    // Isi nilai input form
    koordinatXInput.value = Math.round(x);
    koordinatYInput.value = Math.round(y);


});

cancelButton.addEventListener('click', function() {
    markerForm.reset();
    if (tempMarker) {
        tempMarker.remove();  //  Hapus marker
        tempMarker = null;    //  Reset referensi
    }
});

markerForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(markerForm);

    fetch('/peta/simpan', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Marker saved successfully!', data);
                // Update UI (e.g., add marker without reload)
            } else {
                console.error('Error saving marker:', data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    markerForm.reset();
});

document.addEventListener('DOMContentLoaded', function () {
const markers = document.querySelectorAll('.marker');

markers.forEach(marker => {
    marker.addEventListener('click', function (e) {
        e.stopPropagation();
        // Tutup semua popup lain dulu
        document.querySelectorAll('.popup').forEach(p => p.classList.add('hidden'));

        // Tampilkan popup milik marker yang diklik
        const popup = this.querySelector('.popup');
        popup.classList.remove('hidden');

        // Set timeout untuk sembunyikan popup setelah 3 detik
        setTimeout(() => {
            popup.classList.add('hidden');
        }, 3000);
    });
});

// Tombol hapus marker
document.querySelectorAll('.delete-marker').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        const markerId = this.dataset.id;

        if (confirm("Yakin ingin menghapus marker ini?")) {
            fetch(`/marker/${markerId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
            }).then(res => {
                if (res.ok) {
                    location.reload();
                } else {
                    alert('Gagal menghapus marker.');
                }
            });
        }
    });
});

// Klik di luar marker menutup semua popup
document.addEventListener('click', () => {
    document.querySelectorAll('.popup').forEach(p => p.classList.add('hidden'));
});
});