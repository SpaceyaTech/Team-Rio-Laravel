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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone_no');
            $table->string('image')->default('laravel.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender',['male','female','others'])->nullable();
            $table->text('about');
            $table->enum('status',['active','pending','blocked']);
            $table->timestamp('blocked_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
