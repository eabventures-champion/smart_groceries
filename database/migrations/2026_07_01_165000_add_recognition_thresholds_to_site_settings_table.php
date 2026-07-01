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
            $table->decimal('recognition_platinum_min', 10, 2)->default(500.00)->after('non_student_percent_fee');
            $table->decimal('recognition_gold_min', 10, 2)->default(300.00)->after('recognition_platinum_min');
            $table->decimal('recognition_silver_min', 10, 2)->default(100.00)->after('recognition_gold_min');
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
            $table->dropColumn(['recognition_platinum_min', 'recognition_gold_min', 'recognition_silver_min']);
        });
    }
};
