<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('frets', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté
            $table->string('description')->nullable();
            $table->string('lieu_depart')->nullable();
            $table->string('lieu_arrive')->nullable();
            $table->text('info_comp')->nullable();
            $table->string('type_camion')->nullable();
            $table->string('type_marchandise')->nullable();
            $table->integer('montant')->nullable(); // Montant total du fret
            $table->string('numero_tel'); // Référence à l'utilisateur qui a créé le fret
            $table->string('statut')->nullable(); // Statut du fret
            $table->string('kkiapay_transaction_id')->nullable(); // ID de la transaction Kkiapay
            $table->string('statut_paiement')->nullable(); // Statut du paiement
            $table->timestamps(); // Champs created_at et updated_at
          

            // Index pour les clés étrangères (si besoin)
            $table->foreign('numero_tel')->references('numero_tel')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('frets');
    }
};
