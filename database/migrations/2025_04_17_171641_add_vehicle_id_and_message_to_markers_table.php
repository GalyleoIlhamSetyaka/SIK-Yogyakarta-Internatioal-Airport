<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVehicleIdAndMessageToMarkersTable extends Migration
{
    public function up()
    {
        Schema::table('markers', function (Blueprint $table) {
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            $table->text('message')->nullable();
        });
    }

    public function down()
    {
        Schema::table('markers', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']);
            $table->dropColumn(['vehicle_id', 'message']);
        });
    }
}
