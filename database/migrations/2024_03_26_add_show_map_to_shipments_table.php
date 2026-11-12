<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('shipments')) {
            Schema::table('shipments', function (Blueprint $table) {
                if (!Schema::hasColumn('shipments', 'show_map')) {
                    $table->boolean('show_map')->default(false)->after('updated_at');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('shipments')) {
            Schema::table('shipments', function (Blueprint $table) {
                if (Schema::hasColumn('shipments', 'show_map')) {
                    $table->dropColumn('show_map');
                }
            });
        }
    }
};
 