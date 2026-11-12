<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('shipment_id')->constrained();
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled']);
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded']);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}; 