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
            $table->unsignedBigInteger('fret_id')->nullable();
            $table->foreign('fret_id')->references('id')->on('frets');
            $table->string('statut')->nullable();
            $table->string('statut_paiement')->nullable();
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
