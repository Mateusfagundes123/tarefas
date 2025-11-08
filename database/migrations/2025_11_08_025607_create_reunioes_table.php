<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reunioes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data');
            $table->time('hora');
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reunioes');
    }
};
