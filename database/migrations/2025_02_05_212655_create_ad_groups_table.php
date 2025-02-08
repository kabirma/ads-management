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
        Schema::create('ad_groups', function (Blueprint $table) {
            $table->id();

            $table->string("name",255)->nullable();
            $table->string("type",255)->nullable();
            $table->string("platform",255)->nullable();
            $table->string("campaign_id",255)->nullable();
            $table->string("adgroup_id",255)->nullable();
            $table->string("objective_type",255)->nullable();
            $table->string("budget_mode",255)->nullable();
            $table->string("budget",255)->nullable();
            $table->string("user_id",255)->nullable();
            $table->string("from",255)->nullable();
            $table->string("to",255)->nullable();
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
        Schema::dropIfExists('ad_groups');
    }
};
