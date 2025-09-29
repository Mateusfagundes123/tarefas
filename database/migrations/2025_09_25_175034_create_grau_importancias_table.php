<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grau_importancias', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Baixa, Média, Alta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grau_importancias');
    }
};
