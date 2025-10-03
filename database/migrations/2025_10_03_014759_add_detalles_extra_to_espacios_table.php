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
        Schema::table('espacios', function (Blueprint $table) {
            $table->integer('cantidad_espectadores')->nullable()->after('tipo_area'); 
            $table->integer('salidas_emergencia')->nullable()->after('cantidad_espectadores'); 
            $table->integer('cantidad_vestuarios')->nullable()->after('salidas_emergencia'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espacios', function (Blueprint $table) {
            $table->dropColumn(['cantidad_espectadores', 'salidas_emergencia', 'cantidad_vestuarios']);
        });
    }
};
