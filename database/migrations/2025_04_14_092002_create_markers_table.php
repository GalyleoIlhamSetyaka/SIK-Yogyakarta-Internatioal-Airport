<?php

// database/migrations/xxxx_xx_xx_create_markers_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('markers', function (Blueprint $table) {
            $table->id();
            $table->decimal('x', 10, 2); // Koordinat X
            $table->decimal('y', 10, 2); // Koordinat Y
            $table->string('vehicle_code', 10); // Sesuai dengan panjang kode di vehicles
            $table->text('message');
            $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('vehicle_code')
                ->references('code')
                ->on('vehicles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('markers');
    }
};

