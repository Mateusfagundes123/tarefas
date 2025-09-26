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
        Schema::table('tarefas', function (Blueprint $table) {
        $table->boolean('concluida')->default(false);
        $table->foreignId('grau_importancia_id')->nullable()->constrained('grau_importancias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarefas', function (Blueprint $table) {
        $table->dropColumn('concluida');
        $table->dropConstrainedForeignId('grau_importancia_id');
    });
    }
};
