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
        Schema::create('audits', function (Blueprint $table) {
    $table->id();

    $table->foreignId('building_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->date('tanggal_audit');

    $table->unsignedTinyInteger('nilai_k')->default(3);

    $table->string('nomor_audit')->unique();

    $table->text('catatan')->nullable();

    $table->enum('hasil_knn', [
        'Layak',
        'Kurang Layak',
        'Tidak Layak'
    ])->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
