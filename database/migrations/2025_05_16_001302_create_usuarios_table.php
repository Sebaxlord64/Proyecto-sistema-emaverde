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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('correo', 100)->unique();
            $table->string('password');
            $table->string('ruta_perfil')->nullable();
            $table->enum('estado_cuenta', ['activo', 'inactivo'])->default('activo');
                
            $table->unsignedBigInteger('id_rol'); 
            $table->foreign('id_rol')->references('id')->on('rols')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
