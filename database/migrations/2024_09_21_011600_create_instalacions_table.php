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
        Schema::create('instalacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitante_id');
            $table->string('tipo')->nullable();
            $table->string('tipo_acometida')->nullable();
            $table->string('material')->nullable();
            $table->integer('numero_puntos_proyectados')->nullable();
            $table->integer('numero_puntos_instalados')->nullable();
            $table->integer('numero_puntos_habilitados')->nullable();
            $table->integer('ambientes_aprobados')->nullable();
            $table->integer('numero_ambientes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instalacions');
    }
};
