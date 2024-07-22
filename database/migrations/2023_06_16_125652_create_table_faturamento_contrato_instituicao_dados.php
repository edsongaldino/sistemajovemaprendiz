<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFaturamentoContratoInstituicaoDados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturamento_contrato_instituicao_dados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('faturamento_contrato_id')->constrained('faturamento_contrato');
            $table->decimal('valor_decimo_terceiro', 10,2);
            $table->decimal('valor_ferias', 10,2);
            $table->decimal('valor_terco_ferias', 10,2);
            $table->decimal('valor_inss', 10,2);
            $table->decimal('valor_fgts', 10,2);
            $table->decimal('valor_pis', 10,2);
            $table->decimal('valor_inss_provisionamento', 10,2);
            $table->decimal('valor_fgts_provisionamento', 10,2);
            $table->decimal('valor_pis_provisionamento', 10,2);
            $table->decimal('valor_beneficios', 10,2);
            $table->decimal('valor_descontos', 10,2);
            $table->decimal('valor_exames', 10,2);
            $table->decimal('valor_uniforme', 10,2);
            $table->decimal('valor_issqn', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faturamento_contrato_instituicao_dados');
    }
}
