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
        Schema::table('ads', function (Blueprint $table) {
            $table->longText("image_url")->nullable();
            $table->longText("video_url")->nullable();
            $table->longText("image_id")->nullable();
            $table->longText("video_id")->nullable();

            $table->longText("description")->nullable();
            $table->longText("call_to_action")->nullable();
            $table->longText("landing_page_url")->nullable();
            $table->longText("media_type")->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            //
        });
    }
};
