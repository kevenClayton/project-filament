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
        Schema::create('good_practices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('title');
            $table->text('initial_challenge');
            $table->text('scope_of_action');
            $table->text('actors_involved');
            $table->json('objectives');
            $table->json('actions');
            $table->json('results');
            $table->json('ods_impact')->nullable();
            $table->json('indicators')->nullable();
            $table->text('learnings');
            $table->text('testimonials')->nullable();
            $table->text('next_steps');
            $table->string('contact');
            $table->string('status')->default('draft'); // draft, published, archived
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_practices');
    }
};

