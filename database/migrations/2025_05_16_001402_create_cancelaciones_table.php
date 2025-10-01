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
        Schema::create('cancelaciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_reserva');
            $table->foreign('id_reserva')->references('id')->on('reservas')->onDelete('cascade');

            $table->text('motivo');
            $table->dateTime('fecha_cancelacion');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancelaciones');
    }
};
