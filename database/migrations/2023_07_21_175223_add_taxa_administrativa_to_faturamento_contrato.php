<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxaAdministrativaToFaturamentoContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_contrato', function (Blueprint $table) {
            $table->string('numero_pedido')->after('valor')->nullable();
            $table->decimal('taxa_administrativa', 10,2)->after('valor');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamento_contrato', function (Blueprint $table) {
            $table->dropColumn('taxa_administrativa');
            $table->dropColumn('numero_pedido');
        });
    }
}
