<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToFaturamentoBoletos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_boletos', function (Blueprint $table) {
            $table->renameColumn('codigo_boleto_asaas', 'codigo_boleto');
            $table->renameColumn('bankSlipUrl', 'url_boleto');
            $table->dropColumn('invoiceUrl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamento_boletos', function (Blueprint $table) {
            $table->renameColumn('codigo_boleto', 'codigo_boleto_asaas');
            $table->renameColumn('url_boleto', 'bankSlipUrl');
            $table->string('invoiceUrl')->nullable();
        });
    }
}
