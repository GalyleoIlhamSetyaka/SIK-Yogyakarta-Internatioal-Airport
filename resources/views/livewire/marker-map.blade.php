<div class="space-y-4">
    <div class="relative w-full overflow-auto">
          <div 
          id="map-container"
          class="relative mx-auto border border-gray-300"
          style="background-image: url('{{ asset('img/index/gridmap.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: top left; width: 100%; height: auto; max-width: 1200px;"
          @click="$wire.tambahMarker($event.offsetX, $event.offsetY)"
      >
            <div class="relative" style="padding-top: 42.5%;">
                {{-- Markers --}}
                @foreach ($markers as $marker)
                    <div class="absolute w-5 h-5 rounded-full cursor-pointer"
                         style="left: {{ $marker['koordinat_x'] }}px; top: {{ $marker['koordinat_y'] }}px; background-color: {{ $marker['vehicle'] ? 'blue' : 'red' }};"
                         title="{{ $marker['vehicle']['name'] ?? 'Tanpa kendaraan' }} - {{ $marker['message'] }}"
                         wire:click.stop="editMarker({{ $marker['id'] }})">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Form --}}
    @if ($showForm)
    <div class="bg-white p-4 shadow-md rounded border w-full max-w-md mx-auto">
        <h2 class="text-lg font-semibold mb-4">
            {{ $editingMarkerId ? 'Edit Marker' : 'Tambah Marker' }}
        </h2>

        <form wire:submit.prevent="{{ $editingMarkerId ? 'updateMarker' : 'simpanMarker' }}">
            <div class="mb-2">
                <label class="block text-sm">Kendaraan:</label>
                <select wire:model="selectedVehicleId" class="w-full border rounded">
                    <option value="">Pilih Kendaraan</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->code }})</option>
                    @endforeach
                </select>
                @error('selectedVehicleId') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-2">
                <label class="block text-sm">Pesan:</label>
                <textarea wire:model="message" rows="3" class="w-full border rounded"></textarea>
                @error('message') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" wire:click="batal" class="bg-gray-300 px-4 py-1 rounded">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Simpan</button>
            </div>
        </form>
    </div>
    @endif

</div>
