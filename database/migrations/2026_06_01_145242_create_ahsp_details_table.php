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
        Schema::create('ahsp_details', function (Blueprint $table) {
    $table->id();

    $table->foreignId('ahsp_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->enum('jenis',[
        'material',
        'labor',
        'equipment'
    ]);

    $table->unsignedBigInteger('item_id');

    $table->decimal('koefisien',10,4);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ahsp_details');
    }
};
