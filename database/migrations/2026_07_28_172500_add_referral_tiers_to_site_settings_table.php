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
        Schema::table('site_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('site_settings', 'referral_tier1_amount')) {
                $table->decimal('referral_tier1_amount', 10, 2)->default(3.00)->after('referral_percentage');
            }
            if (!Schema::hasColumn('site_settings', 'referral_tier2_amount')) {
                $table->decimal('referral_tier2_amount', 10, 2)->default(4.00)->after('referral_tier1_amount');
            }
            if (!Schema::hasColumn('site_settings', 'referral_tier3_amount')) {
                $table->decimal('referral_tier3_amount', 10, 2)->default(5.00)->after('referral_tier2_amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['referral_tier1_amount', 'referral_tier2_amount', 'referral_tier3_amount']);
        });
    }
};
