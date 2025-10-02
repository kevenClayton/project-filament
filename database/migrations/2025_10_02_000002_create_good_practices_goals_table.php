<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('good_practices_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_practice_id')->constrained('good_practices')->onDelete('cascade');
            $table->foreignId('goal_id')->constrained('ods_goals')->onDelete('cascade');
            $table->text('action_description')->nullable();
            $table->timestamps();

            // Unique constraint to prevent duplicates
            $table->unique(['good_practice_id', 'goal_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_practices_goals');
    }
};

