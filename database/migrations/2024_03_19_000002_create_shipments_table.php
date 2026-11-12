<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('sender_phone');
            $table->text('sender_address');
            $table->string('receiver_name');
            $table->string('receiver_email');
            $table->string('receiver_phone');
            $table->text('receiver_address');
            $table->string('origin');
            $table->string('destination');
            $table->decimal('weight', 8, 2);
            $table->json('dimensions');
            $table->string('shipping_type');
            $table->timestamp('estimated_delivery_date');
            $table->text('notes')->nullable();
            $table->string('current_location');
            $table->enum('status', ['pending', 'picked_up', 'in_transit', 'out_for_delivery', 'delivered', 'on_hold', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}; 