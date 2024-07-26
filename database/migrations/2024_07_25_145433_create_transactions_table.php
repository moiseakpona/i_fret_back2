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
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('fret_id'); // Clé étrangère vers la table frets
        $table->string('kkiapay_transaction_id');
        $table->integer('montant_paye');
        $table->timestamps();

        // Définir la clé étrangère
        $table->foreign('fret_id')->references('id')->on('frets')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Supprimer la clé étrangère avant de supprimer la table
            $table->dropForeign(['fret_id']);
        });

        Schema::dropIfExists('transactions');
    }
};
