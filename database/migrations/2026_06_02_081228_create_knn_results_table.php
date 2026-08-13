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
        Schema::create('knn_results', function (Blueprint $table) {

    $table->id();

    $table->foreignId('audit_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('data_set_id')
        ->constrained('data_set')
        ->cascadeOnDelete();

    $table->double('distance');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knn_results');
    }
};
