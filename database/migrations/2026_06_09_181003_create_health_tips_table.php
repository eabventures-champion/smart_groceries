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
        Schema::create('health_tips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('icon')->nullable(); // e.g. 🥗, 🧠, 🦷
            $table->string('type_slug')->unique(); // e.g. nutrition, stress, dental
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
        Schema::dropIfExists('health_tips');
    }
};
