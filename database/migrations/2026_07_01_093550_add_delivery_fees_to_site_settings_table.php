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
            $table->decimal('student_flat_fee', 10, 2)->default(15.00)->after('referral_percentage');
            $table->decimal('student_percent_fee', 5, 2)->default(10.00)->after('student_flat_fee');
            $table->decimal('non_student_flat_fee', 10, 2)->default(20.00)->after('student_percent_fee');
            $table->decimal('non_student_percent_fee', 5, 2)->default(12.50)->after('non_student_flat_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'student_flat_fee',
                'student_percent_fee',
                'non_student_flat_fee',
                'non_student_percent_fee'
            ]);
        });
    }
};
