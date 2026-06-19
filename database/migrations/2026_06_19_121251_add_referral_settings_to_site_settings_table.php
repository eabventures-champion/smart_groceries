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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('referral_commission_type')->default('flat')->after('copyright');
            $table->decimal('referral_flat_amount', 10, 2)->default(15.00)->after('referral_commission_type');
            $table->decimal('referral_percentage', 5, 2)->default(10.00)->after('referral_flat_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['referral_commission_type', 'referral_flat_amount', 'referral_percentage']);
        });
    }
};
