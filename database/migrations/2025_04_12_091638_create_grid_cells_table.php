<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGridCellsTable extends Migration
{
    public function up()
    {
        Schema::create('grid_cells', function (Blueprint $table) {
            $table->id();
            $table->string('grid_id')->unique();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->text('message')->nullable();
            $table->integer('x');
            $table->integer('y');
            $table->integer('width');
            $table->integer('height');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grid_cells');
    }
}
