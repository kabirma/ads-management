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
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->dateTime('fdate')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('role_id')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(true);
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
