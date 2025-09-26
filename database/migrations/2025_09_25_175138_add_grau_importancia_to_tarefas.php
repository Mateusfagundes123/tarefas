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
    Schema::table('tarefas', function (Blueprint $table) {
        $table->unsignedBigInteger('grau_importancia_id')->nullable()->after('id');
        $table->foreign('grau_importancia_id')->references('id')->on('grau_importancias');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarefas', function (Blueprint $table) {
            //
        });
    }
};
