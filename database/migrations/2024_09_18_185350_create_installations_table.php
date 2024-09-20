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
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->string('installation_type');
            $table->string('connection_type');
            $table->string('installation_material')->nullable();
            $table->integer('installation_points_number')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->float('total_length')->nullable();
            $table->foreignId('inspector_id'); // Relación con inspectors
            $table->date('scheduled_internal_installation_date')->nullable();
            $table->date('internal_installation_start_date')->nullable();
            $table->date('internal_installation_end_date')->nullable();
            $table->date('acometida_installation_end_date')->nullable();
            $table->date('scheduled_habilitation_date')->nullable();
            $table->date('document_submission_date')->nullable();
            $table->boolean('valve_approved')->nullable();
            $table->float('nominal_valve_diameter')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installations');
    }
};
