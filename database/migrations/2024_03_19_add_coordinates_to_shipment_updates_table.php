<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('shipment_updates')) {
            Schema::table('shipment_updates', function (Blueprint $table) {
                if (!Schema::hasColumn('shipment_updates', 'latitude')) {
                    $table->decimal('latitude', 10, 8)->nullable()->after('location');
                }
                if (!Schema::hasColumn('shipment_updates', 'longitude')) {
                    $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('shipment_updates')) {
            Schema::table('shipment_updates', function (Blueprint $table) {
                $columnsToDrop = [];
                if (Schema::hasColumn('shipment_updates', 'latitude')) {
                    $columnsToDrop[] = 'latitude';
                }
                if (Schema::hasColumn('shipment_updates', 'longitude')) {
                    $columnsToDrop[] = 'longitude';
                }
                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }
    }
};