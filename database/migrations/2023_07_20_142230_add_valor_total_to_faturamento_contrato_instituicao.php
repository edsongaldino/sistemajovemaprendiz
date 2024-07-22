<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorTotalToFaturamentoContratoInstituicao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_contrato_instituicao_dados', function (Blueprint $table) {
            $table->decimal('valor_total', 10,2)->after('valor_issqn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamento_contrato_instituicao_dados', function (Blueprint $table) {
            $table->dropColumn('valor_total');
        });
    }
}
