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
        DB::statement("
            ALTER TABLE ahsp_details
            MODIFY jenis ENUM(
                'material',
                'labor',
                'equipment',
                'support_cost'
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE ahsp_details
            MODIFY jenis ENUM(
                'material',
                'labor',
                'equipment'
            )
        ");
    }
};
