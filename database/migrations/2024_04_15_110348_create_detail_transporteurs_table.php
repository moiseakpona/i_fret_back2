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
        Schema::create('detail_transporteurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('num_cip')->unsigned()->length(10)->unique();
            $table->string('cip');
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
        Schema::dropIfExists('detail_transporteurs');
    }
};
