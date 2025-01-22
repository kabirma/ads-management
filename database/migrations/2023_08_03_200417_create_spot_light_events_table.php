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
        Schema::create('spot_light_events', function (Blueprint $table) {
            $table->increments("id");

            $table->string("artist",255)->nullable();
           
            $table->date("date",255)->nullable();
            $table->string("time",255)->nullable();

            $table->string("location",255)->nullable();
            $table->string("latitude",255)->nullable();
            $table->string("longitude",255)->nullable();

            $table->string("image",255)->nullable();
            $table->longText("description")->nullable();
            $table->longText("about")->nullable();
            
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
        Schema::dropIfExists('spot_light_events');
    }
};
