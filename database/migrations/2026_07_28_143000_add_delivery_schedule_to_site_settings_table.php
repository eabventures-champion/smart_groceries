<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('site_settings')) {
            Schema::table('site_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('site_settings', 'delivery_days')) {
                    $table->string('delivery_days')->default('1,4,6')->after('min_order_amount');
                }
                if (!Schema::hasColumn('site_settings', 'delivery_cutoff_time')) {
                    $table->string('delivery_cutoff_time')->default('11:00')->after('delivery_days');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('site_settings')) {
            Schema::table('site_settings', function (Blueprint $table) {
                if (Schema::hasColumn('site_settings', 'delivery_days')) {
                    $table->dropColumn('delivery_days');
                }
                if (Schema::hasColumn('site_settings', 'delivery_cutoff_time')) {
                    $table->dropColumn('delivery_cutoff_time');
                }
            });
        }
    }
};
