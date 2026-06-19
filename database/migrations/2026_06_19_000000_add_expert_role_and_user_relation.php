<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Create the Spatie 'expert' role
        Role::findOrCreate('expert');

        // 2. Change 'role' column in 'users' table to string to support 'expert'
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->change();
        });

        // 3. Add 'user_id' foreign key to 'experts' table
        Schema::table('experts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'vendor', 'user'])->default('user')->change();
        });

        $role = Role::where('name', 'expert')->first();
        if ($role) {
            $role->delete();
        }
    }
};
