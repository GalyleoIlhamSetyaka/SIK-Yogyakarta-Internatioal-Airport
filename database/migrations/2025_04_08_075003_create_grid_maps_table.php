<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grid_maps', function (Blueprint $table) {
            $table->id();
            $table->string('grid_id'); // contoh: A1, B2, D13
            $table->string('color')->nullable(); // warna grid, contoh: #FF0000
            $table->text('message')->nullable(); // pesan yang ingin ditampilkan
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grid_maps');
    }
};
