<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMotivoDesligamentoToAtualizacoesContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atualizacoes_contrato', function (Blueprint $table) {
            $table->string('motivo_desligamento', 100)->nullable()->after('arquivo');
            $table->string('situacao_contrato', 50)->nullable()->after('arquivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atualizacoes_contrato', function (Blueprint $table) {
            $table->string('motivo_desligamento');
            $table->string('situacao_contrato');
        });
    }
}
