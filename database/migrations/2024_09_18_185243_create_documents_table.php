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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->unique();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('installation_id');// Relación con installations
            $table->unsignedBigInteger('enterprises_id'); // Relación con empresas concesionarias
            $table->unsignedBigInteger('project_id'); // Relación con projects
            $table->date('approval_registration_date')->nullable();
            $table->date('contract_approval_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
