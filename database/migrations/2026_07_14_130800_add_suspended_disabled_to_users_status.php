<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Expand status enum to include 'suspended' and 'disabled'
        DB::statement("ALTER TABLE `users` MODIFY `status` ENUM('active', 'inactive', 'suspended', 'disabled') NOT NULL DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // First set any suspended/disabled users back to inactive before shrinking the enum
        DB::table('users')->whereIn('status', ['suspended', 'disabled'])->update(['status' => 'inactive']);
        DB::statement("ALTER TABLE `users` MODIFY `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active'");
    }
};
