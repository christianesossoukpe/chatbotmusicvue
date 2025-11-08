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
     // Migration pour sauvegarder les évaluations
Schema::create('evaluations_musicales', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('instrument');
    $table->decimal('note', 3, 1);
    $table->text('evaluation');
    $table->json('conseils');
    $table->json('reponses');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations_musicales');
    }
};
