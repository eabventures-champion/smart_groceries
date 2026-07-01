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
        Schema::create('recognition_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('min_spent', 10, 2);
            $table->decimal('discount_percent', 5, 2);
            $table->string('badge_style')->default('primary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recognition_tiers');
    }
};
