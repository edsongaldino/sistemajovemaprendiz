<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->enum('dia_semana_teorico', ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira'])->after('periodo_teorico')->nullable();
            $table->decimal('valor_bolsa', 10,2)->after('atuacao_comercial')->nullable();
            $table->string('valor_bolsa_extenso')->after('atuacao_comercial')->nullable();
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
            $table->dropColumn('dia_semana_teorico');
            $table->dropColumn('valor_bolsa');
            $table->dropColumn('valor_bolsa_extenso');
        });
    }
}
