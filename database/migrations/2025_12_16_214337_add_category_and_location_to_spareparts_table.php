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
        Schema::table('spareparts', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('harga')
                  ->constrained('categories')->nullOnDelete();
            $table->string('lokasi_rak', 50)->nullable()->after('category_id');
            $table->integer('stok_minimum')->default(5)->after('lokasi_rak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spareparts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'lokasi_rak', 'stok_minimum']);
        });
    }
};
