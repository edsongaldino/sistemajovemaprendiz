<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToContratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->enum('situacao', ['Ativo', 'Bloqueado', 'Cancelado'])->after('data_final');
            $table->enum('tipo', ['Novo', 'Reposição'])->after('data_final');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('situacao');
            $table->dropColumn('tipo');
        });
    }
}
