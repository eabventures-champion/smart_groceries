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
            if (!Schema::hasColumn('site_settings', 'show_status_student')) {
                $table->boolean('show_status_student')->default(true)->after('show_status_identity');
            }
            if (!Schema::hasColumn('site_settings', 'show_status_non_student')) {
                $table->boolean('show_status_non_student')->default(false)->after('show_status_student');
            }
            if (!Schema::hasColumn('site_settings', 'show_status_partner')) {
                $table->boolean('show_status_partner')->default(true)->after('show_status_non_student');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['show_status_student', 'show_status_non_student', 'show_status_partner']);
        });
    }
};
