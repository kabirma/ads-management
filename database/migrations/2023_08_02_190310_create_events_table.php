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
        Schema::create('events', function (Blueprint $table) {
            $table->increments("id");

            $table->string("title",255)->nullable();
            $table->string("genre",255)->nullable();
           
            $table->date("date",255)->nullable();
            $table->string("start_time",255)->nullable();
            $table->string("end_time",255)->nullable();

            $table->string("location",255)->nullable();
            $table->string("latitude",255)->nullable();
            $table->string("longitude",255)->nullable();

            $table->string("image",255)->nullable();
            $table->longText("description")->nullable();
            
            $table->integer("status")->default(0);

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
        Schema::dropIfExists('events');
    }
};
