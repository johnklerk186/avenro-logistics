<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users');
            $table->string('plate_number')->unique();
            $table->string('vehicle_type');
            $table->string('model');
            $table->enum('status', ['active', 'maintenance', 'inactive']);
            $table->string('current_location')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}; 