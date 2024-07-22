<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturamentoContratoEmpresaDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturamento_contrato_empresa_dados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('faturamento_contrato_id')->constrained('faturamento_contrato');
            $table->decimal('valor_beneficios', 10,2);
            $table->decimal('valor_descontos', 10,2);
            $table->decimal('valor_exames', 10,2);
            $table->decimal('valor_uniforme', 10,2);
            $table->decimal('valor_issqn', 10,2);
            $table->decimal('valor_total', 10,2);
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
        Schema::dropIfExists('faturamento_contrato_empresa_dados');
    }
}
