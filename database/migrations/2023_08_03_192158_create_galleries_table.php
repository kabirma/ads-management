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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->longText("summary")->nullable();
            $table->string("date",255)->nullable();
            $table->string("artist",255)->nullable();
            $table->string("media",255)->nullable();    
            $table->string("media_type",255)->nullable();
            $table->integer("status")->default(0);
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete("cascade");
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
        Schema::dropIfExists('galleries');
    }
};
