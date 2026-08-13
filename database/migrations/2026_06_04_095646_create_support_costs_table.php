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
    Schema::create('support_costs', function (Blueprint $table) {

        $table->id();

        $table->string('kode')->unique();

        $table->string('nama_biaya');

        $table->enum('kategori', [
            'Transportasi',
            'Operasional',
            'Lain-lain'
        ]);

        $table->decimal('harga_satuan', 15, 2);

        $table->text('keterangan')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_costs');
    }
};
