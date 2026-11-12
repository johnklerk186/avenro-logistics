<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('package_name')->nullable()->after('destination');
            $table->string('package_type')->nullable()->after('package_name');
            $table->decimal('declared_value', 10, 2)->nullable()->after('dimensions');
            $table->text('package_description')->nullable()->after('declared_value');

            $table->string('shipment_mode')->nullable()->after('shipping_type');
            $table->string('service_type')->nullable()->after('shipment_mode');
            $table->string('carrier')->nullable()->after('service_type');
            $table->string('priority')->nullable()->after('carrier');
            $table->string('carrier_reference_no')->nullable()->after('priority');
            $table->string('product')->nullable()->after('carrier_reference_no');
            $table->unsignedInteger('qty')->nullable()->after('product');
            $table->string('payment_mode')->nullable()->after('qty');
            $table->decimal('total_freight', 10, 2)->nullable()->after('payment_mode');

            $table->time('departure_time')->nullable()->after('estimated_delivery_date');
            $table->date('pickup_date')->nullable()->after('departure_time');
            $table->time('pickup_time')->nullable()->after('pickup_date');

            $table->text('comments')->nullable()->after('pickup_time');
            $table->text('special_instructions')->nullable()->after('comments');
        });
    }

    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn([
                'package_name',
                'package_type',
                'declared_value',
                'package_description',
                'shipment_mode',
                'service_type',
                'carrier',
                'priority',
                'carrier_reference_no',
                'product',
                'qty',
                'payment_mode',
                'total_freight',
                'departure_time',
                'pickup_date',
                'pickup_time',
                'comments',
                'special_instructions',
            ]);
        });
    }
};
