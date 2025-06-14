<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiCampaignHistoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('ai_campaign_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();

            $table->string('campaign_goal');
            $table->text('business_keywords')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('target_choices')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('platform')->nullable();
            $table->boolean('is_first_campaign')->default(true);

            $table->string('previous_platform')->nullable();
            $table->string('best_platform')->nullable();
            $table->string('worst_platform')->nullable();
            $table->string('previous_budget')->nullable();
            $table->string('campaign_duration')->nullable();
            $table->text('issue_reason')->nullable();

            $table->text('ai_description')->nullable();
            $table->text('ai_strategy')->nullable();
            $table->text('ai_values')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_campaign_histories');
    }
}
