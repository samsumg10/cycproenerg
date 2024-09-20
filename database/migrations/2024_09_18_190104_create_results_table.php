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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents'); // Relación con documents
            $table->string('tc_result')->nullable();
            $table->string('connection_result')->nullable();
            $table->string('external_installation_result')->nullable();
            $table->boolean('rejected')->nullable();
            $table->boolean('cancelled')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->boolean('observed_for_installer')->nullable();
            $table->boolean('observed_for_concessionaire')->nullable();
            $table->boolean('enabled')->nullable();
            $table->date('test_date')->nullable();
            $table->integer('attempt_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
