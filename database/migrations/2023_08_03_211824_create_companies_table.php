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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string("name",255)->nullable();
            $table->string("phone",255)->nullable();
            $table->string("email",255)->nullable();
            $table->string("address",255)->nullable();
            
            $table->string("short_description",255)->nullable();

            $table->string("facebook",255)->nullable();
            $table->string("twitter",255)->nullable();
            $table->string("instagram",255)->nullable();
            $table->string("snapchat",255)->nullable();

            $table->string("about_heading",255)->nullable();
            $table->string("about_image",255)->nullable();
            $table->longText("about_content")->nullable();

            $table->string("mission_heading",255)->nullable();
            $table->string("mission_image",255)->nullable();
            $table->longText("mission_content")->nullable();


            $table->string("cover",255)->nullable();
            $table->string("logo",255)->nullable();
            $table->string("favicon",255)->nullable();

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
        Schema::dropIfExists('companies');
    }
};
