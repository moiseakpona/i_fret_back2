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
            $table->string('description');
            $table->string('lieu_depart');
            $table->string('lieu_arrive');
            $table->string('info_comp');
            $table->string('montant')->nullable();
            $table->foreign('montant')->references('montant')->on('soumissionnaires');
            $table->string('numero_tel');
            $table->foreign('numero_tel')->references('numero_tel')->on('users');
            $table->string('statut')->nullable();
            $table->string('kkiapay_transaction_id')->nullable();
            $table->string('statut_paiement')->nullable();
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
