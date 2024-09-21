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
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitante_id');
            $table->timestamp('fecha_realizacion')->nullable();
            $table->integer('nro_intento')->nullable();
            $table->boolean('hermeticidad_aprobada')->nullable();
            $table->integer('presion_operacion_hermeticidad_mbar')->nullable();
            $table->integer('presion_inicial_prueba_hermeticidad_mbar')->nullable();
            $table->integer('presion_final_prueba_hermeticidad_mbar')->nullable();
            $table->integer('tiempo_prueba_hermeticidad_min')->nullable();
            $table->boolean('presion_artefacto_aprobada')->nullable();
            $table->integer('presion_artefacto_mbar')->nullable();
            $table->boolean('prueba_monoxido_aprobada')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pruebas');
    }
};
