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
        Schema::create('log_responses', function (Blueprint $table) {
            $table->id();
            $table->string("reference_id",255)->nullable();
            $table->string("reference_table",255)->nullable();
            $table->longText("request")->nullable();
            $table->longText("url")->nullable();
            $table->longText("response")->nullable();
            $table->longText("user_id")->nullable();
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
        Schema::dropIfExists('log_responses');
    }
};
