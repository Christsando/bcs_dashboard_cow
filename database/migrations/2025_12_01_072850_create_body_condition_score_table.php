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
        Schema::create('body_condition_score', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('bcs_score');
            $table->date('assessment_date');
            $table->text('notes')->nullable();
            $table->foreignId('cow_id')->constrained('cows')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body_condition_score');
    }
};
