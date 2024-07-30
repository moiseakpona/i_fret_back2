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
        Schema::create('soumissionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('localisation');
            $table->string('montant');
            $table->string('numero_tel_transport')->nullable();
            $table->foreign('numero_tel_transport')->references('numero_tel')->on('users');
            $table->unsignedBigInteger('vehicule_id')->nullable();
            $table->foreign('vehicule_id')->references('id')->on('vehicules');
            $table->string('numero_tel_chauffeur')->nullable();
            $table->foreign('numero_tel_chauffeur')->references('numero_tel')->on('users');
            $table->unsignedBigInteger('demande_id')->nullable();
            $table->foreign('demande_id')->references('id')->on('demandes');
            $table->string('statut_soumission')->nullable();
            $table->string('statut_demande')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soumissionnaires');
    }
};
