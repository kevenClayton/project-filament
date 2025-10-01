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
        Schema::table('boas_praticas', function (Blueprint $table) {
            $table->foreignId('ods_objective_id')->nullable()->after('empresa_id')->constrained('ods_objectives')->nullOnDelete();
            $table->foreignId('ods_goal_id')->nullable()->after('ods_objective_id')->constrained('ods_goals')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boas_praticas', function (Blueprint $table) {
            $table->dropForeign(['ods_objective_id']);
            $table->dropForeign(['ods_goal_id']);
            $table->dropColumn(['ods_objective_id', 'ods_goal_id']);
        });
    }
};

