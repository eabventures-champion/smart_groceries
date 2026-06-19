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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expert_category_id');
            $table->string('name');
            $table->string('initials')->nullable();
            $table->text('specialty_description');
            $table->string('availability_schedule');
            $table->string('whatsapp_number');
            $table->text('whatsapp_message')->nullable();
            $table->string('avatar_bg_color')->default('#e6f7ef');
            $table->string('avatar_text_color')->default('#2e8b5e');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('expert_category_id')->references('id')->on('expert_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experts');
    }
};
