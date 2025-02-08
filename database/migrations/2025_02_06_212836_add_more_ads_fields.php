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
            $table->string("platform",255)->nullable();
            $table->string("campaign_id",255)->nullable();
            $table->string("adgroup_id",255)->nullable();
            $table->string("user_id",255)->nullable();
            $table->string("from",255)->nullable();
            $table->string("to",255)->nullable();
            $table->integer("status")->default(0);
            $table->longText("data")->nullable();
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
