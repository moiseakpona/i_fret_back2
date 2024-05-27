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
        Schema::create('recevoirs', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->string('statut')->nullable();
            $table->string('numero_tel');
            $table->foreign('numero_tel')->references('numero_tel')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recevoirs');
    }
};
