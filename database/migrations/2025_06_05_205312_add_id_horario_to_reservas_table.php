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
        Schema::table('reservas', function (Blueprint $table) {
            // Agrega id_horario
            if (!Schema::hasColumn('reservas', 'id_horario')) {
                $table->unsignedBigInteger('id_horario')->after('id_espacio');
                $table->foreign('id_horario')->references('id')->on('horarios')->onDelete('cascade');
            }

            // Agrega id_ubicacion
            if (!Schema::hasColumn('reservas', 'id_ubicacion')) {
                $table->unsignedBigInteger('id_ubicacion')->after('id_horario');
                $table->foreign('id_ubicacion')->references('id')->on('ubicacions')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            if (Schema::hasColumn('reservas', 'id_ubicacion')) {
                $table->dropForeign(['id_ubicacion']);
                $table->dropColumn('id_ubicacion');
            }

            if (Schema::hasColumn('reservas', 'id_horario')) {
                $table->dropForeign(['id_horario']);
                $table->dropColumn('id_horario');
            }
        });
    }
};
