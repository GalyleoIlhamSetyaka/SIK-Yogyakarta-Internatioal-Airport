@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Grid Map Interaktif - Bandara Internasional Yogyakarta</h1>

    <!-- Grid Map Image -->
    <div class="relative">
        <img src="{{ asset('img/kendaraan/gripmap.png') }}" alt="Grid Map" class="w-full h-auto">

        <!-- Overlay Grid using absolute positioning -->
        @foreach ($gridData as $grid)
            <div 
                class="absolute border border-gray-200 cursor-pointer text-xs text-white flex items-center justify-center font-semibold" 
                style="
                    top: {{ $grid->top }}px; 
                    left: {{ $grid->left }}px; 
                    width: {{ $grid->width }}px; 
                    height: {{ $grid->height }}px; 
                    background-color: {{ $grid->color ?? 'transparent' }};
                "
                wire:click="selectGrid('{{ $grid->grid_id }}')"
                title="{{ $grid->message ?? 'Kosong' }}"
            >
                {{ $grid->grid_id }}
            </div>
        @endforeach
    </div>

    <!-- Form Editing Grid Data -->
    @if ($selectedGrid)
    <div class="mt-6 p-4 bg-white shadow rounded w-full md:w-1/2">
        <h2 class="text-lg font-semibold mb-2">Edit Grid: {{ $selectedGrid->grid_id }}</h2>

        <form wire:submit.prevent="updateGrid">
            <div class="mb-4">
                <label for="color" class="block text-sm font-medium">Warna</label>
                <input type="color" wire:model="selectedGrid.color" class="w-16 h-10 border rounded">
            </div>

            <div class="mb-4">
                <label for="message" class="block text-sm font-medium">Pesan</label>
                <textarea wire:model="selectedGrid.message" class="w-full border rounded p-2"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
        </form>
    </div>
    @endif

    <!-- Daftar Kendaraan -->
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Daftar Kendaraan</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach ($vehicles as $vehicle)
            <div class="bg-white p-4 rounded shadow text-center">
                <img src="{{ asset('img/kendaraan/' . $vehicle['image']) }}" alt="{{ $vehicle['code'] }}" class="w-full h-24 object-contain mx-auto">
                <div class="mt-2 text-sm font-semibold">{{ $vehicle['code'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
