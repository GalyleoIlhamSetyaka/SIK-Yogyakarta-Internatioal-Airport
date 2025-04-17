<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkersTable extends Migration
{
    public function up()
    {
        Schema::create('markers', function (Blueprint $table) {
            $table->id();
            $table->integer('koordinat_x'); // Atau float/decimal tergantung kebutuhan presisi
            $table->integer('koordinat_y'); // Atau float/decimal tergantung kebutuhan presisi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('markers');
    }
}