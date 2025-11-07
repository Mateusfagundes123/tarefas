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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_arquivo');
            $table->string('tipo')->nullable(); // Ex: pdf, docx, jpg
            $table->integer('tamanho')->nullable(); // Em KB
            $table->string('caminho_arquivo'); // Caminho do upload
            $table->unsignedBigInteger('projeto_id')->nullable();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();

            // Relacionamentos (caso existam tabelas projetos e clientes)
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('set null');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
