<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->bigInteger('user_validacao')->unsigned()->after('data_inicial')->nullable();
            $table->date('data_validacao')->after('data_inicial')->nullable();
            $table->enum('etapa_faturamento', ['Validação', 'Nota Fiscal', 'Boleto', 'Envio Relatório', 'Envio Faturamento', 'Finalizado'])->default('Validação')->after('data_inicial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->dropColumn('data_validacao');
            $table->dropColumn('user_validacao');
            $table->dropColumn('etapa_faturamento');
        });
    }
};
