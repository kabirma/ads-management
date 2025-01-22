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
        Schema::create('b_t_s', function (Blueprint $table) {
            $table->id();
            $table->longText("summary")->nullable();
            $table->string("date",255)->nullable();
            $table->string("image",255)->nullable();
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
        Schema::dropIfExists('b_t_s');
    }
};
