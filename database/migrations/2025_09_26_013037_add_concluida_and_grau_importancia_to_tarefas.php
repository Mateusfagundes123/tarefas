<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tarefas', function (Blueprint $table) {
            // adiciona coluna 'concluida' se não existir
            if (! Schema::hasColumn('tarefas', 'concluida')) {
                $table->boolean('concluida')->default(false)->after('dataentrega');
            }

            // adiciona coluna 'grau_importancia_id' como FK se não existir
            if (! Schema::hasColumn('tarefas', 'grau_importancia_id')) {
                $table->unsignedBigInteger('grau_importancia_id')->nullable()->after('concluida');
                // tenta criar FK (se a tabela grau_importancias existir)
                if (Schema::hasTable('grau_importancias')) {
                    $table->foreign('grau_importancia_id')
                          ->references('id')
                          ->on('grau_importancias')
                          ->onDelete('set null');
                }
            }
        });
    }

    public function down()
    {
        Schema::table('tarefas', function (Blueprint $table) {
            if (Schema::hasColumn('tarefas', 'grau_importancia_id')) {
                // tenta dropar FK se existir
                try {
                    $table->dropForeign(['grau_importancia_id']);
                } catch (\Throwable $e) { /* ignora se não existir FK */ }

                $table->dropColumn('grau_importancia_id');
            }

            if (Schema::hasColumn('tarefas', 'concluida')) {
                $table->dropColumn('concluida');
            }
        });
    }
};
