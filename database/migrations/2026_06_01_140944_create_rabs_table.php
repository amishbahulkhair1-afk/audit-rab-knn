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
        Schema::create('rabs', function (Blueprint $table) {
    $table->id();

    $table->string('nomor_rab')->unique();

    $table->foreignId('audit_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->date('tanggal_rab');

    $table->decimal('total_biaya',15,2)
        ->default(0);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rabs');
    }
};
