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
        Schema::create('frets', function (Blueprint $table) {
            $table->id();
            $table->string('lieu_depart');
            $table->string('lieu_arrive');
            $table->string('montant');
            $table->string('description');
            $table->string('numero_tel');
            $table->foreign('numero_tel')->references('numero_tel')->on('users');
            $table->unsignedBigInteger('id_demande')->nullable();
            $table->foreign('id_demande')->references('id')->on('demandes')->onDelete('cascade');
            $table->string('statut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frets');
    }
};
