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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule')->unique();
            $table->string('photo_camion')->nullable(); // Store the image path
            $table->string('carte_grise')->nullable(); // Store the image path
            $table->string('visite_technique')->nullable(); // Store the image path
            $table->string('assurance')->nullable(); // Store the image path
            $table->date('visite_exp')->nullable();
            $table->date('assurance_exp')->nullable();
            $table->string('statut')->nullable();
            $table->string('numero_tel');
            $table->foreign('numero_tel')->references('numero_tel')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
