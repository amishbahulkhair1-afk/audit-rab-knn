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
        Schema::create('rab_details', function (Blueprint $table) {
    $table->id();

    $table->foreignId('rab_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('ahsp_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->decimal('volume',10,2);

    $table->decimal('harga_satuan',15,2);

    $table->decimal('subtotal',15,2);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rab_details');
    }
};
