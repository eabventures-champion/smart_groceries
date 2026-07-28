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
        if (Schema::hasTable('site_settings') && !Schema::hasColumn('site_settings', 'partner_referral_amount')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->decimal('partner_referral_amount', 10, 2)->default(3.00)->after('referral_percentage');
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
        if (Schema::hasTable('site_settings') && Schema::hasColumn('site_settings', 'partner_referral_amount')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('partner_referral_amount');
            });
        }
    }
};
