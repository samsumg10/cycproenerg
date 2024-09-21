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
        Schema::create('solicitantes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento_identificacion')->nullable();
            $table->string('numero_documento_identificacion')->nullable();
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitantes');
    }
};
