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
        if (!Schema::hasColumn('product_attributes', 'sort_order')) {
            Schema::table('product_attributes', function (Blueprint $table) {
                $table->integer('sort_order')->default(0)->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('product_attributes', 'sort_order')) {
            Schema::table('product_attributes', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
};
