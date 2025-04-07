@extends('layouts.app')

@section('content')
<div x-data="gridMap()" class="p-4">
    <h1 class="text-2xl font-bold mb-4">Grid Map Bandara Internasional Yogyakarta</h1>

    <!-- Grid Map -->
    <div class="grid border w-full max-w-full overflow-auto"
         style="grid-template-columns: repeat(30, minmax(40px, 1fr));">
        @php $rows = range('A', 'N'); @endphp
        @foreach ($rows as $row)
            @for ($col = 1; $col <= 29; $col++)
                @php $loc = $row . $col; @endphp
                <div
                    class="aspect-square border border-gray-300 text-xs flex items-center justify-center cursor-pointer hover:bg-blue-100 relative"
                    @click="openModal('{{ $loc }}')">
                    {{ $loc }}
                    @if(isset($vehicleData[$loc]))
                    <img 
                        src="{{ asset('img/kendaraan/' . strtolower($vehicleData[$loc]['vehicle_type']) . '.png') }}" 
                        alt="kendaraan" 
                        class="absolute bottom-1 right-1 w-5 h-5 object-contain"
                        title="{{ $vehicleData[$loc]['vehicle_id'] }} - {{ $vehicleData[$loc]['vehicle_type'] }}"
                    />
                    @endif
                </div>
            @endfor
        @endforeach
    </div>

    <!-- Modal -->
    <div x-show="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded shadow-lg p-6 w-full max-w-md" @click.away="show = false">
            <h2 class="text-lg font-bold mb-4">Tambah Kendaraan - <span x-text="location"></span></h2>
            <form method="POST" action="{{ route('grid.save') }}">
                @csrf
                <input type="hidden" name="location" :value="location">

                <label class="block mb-2 text-sm">Jenis Kendaraan</label>
                <input type="text" name="vehicle_type" class="w-full border p-2 rounded mb-4" required>

                <label class="block mb-2 text-sm">Kode Kendaraan</label>
                <input type="text" name="vehicle_id" class="w-full border p-2 rounded mb-4" required>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="show = false" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function gridMap() {
        return {
            show: false,
            location: '',
            openModal(loc) {
                this.location = loc;
                this.show = true;
            },
        }
    }
</script>
@endsection
