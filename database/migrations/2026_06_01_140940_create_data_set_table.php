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
        Schema::create('data_set', function (Blueprint $table) {
    $table->id();

    $table->string('kode_data')->unique();

    $table->string('nama_bangunan');

    $table->enum('jenis_konstruksi', [
                'Gedek',
                'Semi Permanen',
                'Permanen',
                'Permanen Bertingkat'
            ]);

    $table->unsignedTinyInteger('pondasi');

    $table->unsignedTinyInteger('struktur');

    $table->unsignedTinyInteger('atap');

    $table->unsignedTinyInteger('dinding');

    $table->unsignedTinyInteger('lantai');

    $table->unsignedTinyInteger('plafon');

    $table->unsignedTinyInteger('pintu');

    $table->unsignedTinyInteger('jendela');

    $table->unsignedTinyInteger('listrik');

    $table->unsignedTinyInteger('sanitasi');

    $table->text('keterangan')->nullable();

    $table->enum('kategori', [
        'Layak',
        'Kurang Layak',
        'Tidak Layak'
    ]);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_set');
    }
};
