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
        if (Schema::hasTable('site_settings') && !Schema::hasColumn('site_settings', 'min_order_amount')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->decimal('min_order_amount', 10, 2)->default(50.00)->after('non_student_percent_fee');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('site_settings') && Schema::hasColumn('site_settings', 'min_order_amount')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('min_order_amount');
            });
        }
    }
};
