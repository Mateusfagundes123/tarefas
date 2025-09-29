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
        $table->date('dataentrega')->nullable();
    });
}

public function down()
{
    Schema::table('tarefas', function (Blueprint $table) {
        $table->dropColumn('dataentrega');
    });
}
};
