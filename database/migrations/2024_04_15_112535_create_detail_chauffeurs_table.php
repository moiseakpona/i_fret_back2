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
        Schema::create('detail_chauffeurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_permis')->unique();
            $table->string('permis');
            $table->string('date_exp');
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
        Schema::dropIfExists('detail_chauffeurs');
    }
};
