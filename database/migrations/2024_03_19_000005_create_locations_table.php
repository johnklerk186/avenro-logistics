<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type'); // 'shipment' or 'vehicle'
            $table->unsignedBigInteger('entity_id');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamp('last_updated')->useCurrent();
            $table->timestamps();

            $table->index(['entity_type', 'entity_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
}; 