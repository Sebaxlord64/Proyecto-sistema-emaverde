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
        $table->boolean('visible_usuario')->default(true);
    });
}

public function down(): void
{
    Schema::table('reservas', function (Blueprint $table) {
        $table->dropColumn('visible_usuario');
    });
}

};
