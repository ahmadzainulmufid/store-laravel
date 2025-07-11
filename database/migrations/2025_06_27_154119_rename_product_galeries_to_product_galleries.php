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
        Schema::table('product_galleries', function (Blueprint $table) {
            Schema::rename('product_galeries', 'product_galleries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_galleries', function (Blueprint $table) {
            Schema::rename('product_galleries', 'product_galeries');
        });
    }
};
