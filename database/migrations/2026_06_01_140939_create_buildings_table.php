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
        Schema::create('buildings', function (Blueprint $table) {
    $table->id();

    $table->string('kode_bangunan')->unique();

    $table->string('nama_bangunan');

    $table->string('rayon');

    $table->text('alamat');

    $table->year('tahun_berdiri')->nullable();

    $table->decimal('luas_bangunan', 10, 2)->nullable();

    $table->string('jenis_bangunan')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
