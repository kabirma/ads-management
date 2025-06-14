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

        Schema::create('ai_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // if you have users
            $table->string('campaign_goal');
            $table->text('business_keywords');
            $table->string('age');
            $table->string('gender');
            $table->string('target_choices');
            $table->string('budget_range')->nullable();
            $table->string('platform')->nullable();

            // AI responses
            $table->text('ai_description')->nullable();
            $table->text('ai_strategy')->nullable();
            $table->string('ai_values')->nullable();

            // campaign meta
            $table->boolean('is_first_campaign')->default(true);
            $table->string('previous_platform')->nullable();
            $table->string('best_platform')->nullable();
            $table->string('worst_platform')->nullable();
            $table->string('previous_budget')->nullable();
            $table->string('campaign_duration')->nullable();
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
        Schema::dropIfExists('ai_campaigns');
    }
};
