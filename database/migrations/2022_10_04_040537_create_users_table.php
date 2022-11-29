<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('password');
            $table->enum('role', ['User', 'Administrator'])->default('User');
            $table->timestamps();
        });
        DB::table('users')->insert([
            'login' => 'admin',
            'name' => 'admin',
            'password' => Hash::make('123456'),
            'role' => 'Administrator'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
