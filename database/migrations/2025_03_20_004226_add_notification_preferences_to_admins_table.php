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
        Schema::table('admins', function (Blueprint $table) {
            $table->boolean('email_notifications')->default(true);
            $table->boolean('shipment_updates')->default(true);
            $table->boolean('new_orders')->default(true);
            $table->string('timezone')->default('UTC');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn([
                'email_notifications',
                'shipment_updates',
                'new_orders',
                'timezone'
            ]);
        });
    }
};
