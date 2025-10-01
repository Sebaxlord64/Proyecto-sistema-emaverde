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
        Schema::create('ubicacions', function (Blueprint $table) {
          $table->id();

            // Relación con espacios
            $table->unsignedBigInteger('id_espacio');
            $table->foreign('id_espacio')->references('id')->on('espacios')->onDelete('cascade');

            // Nuevos campos descriptivos
            $table->string('zona', 100);
            $table->string('avenida_calle', 150);
            $table->string('imagen')->nullable(); // ruta de imagen opcional

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
