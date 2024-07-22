<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCamposToFaturamentoNF extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_nf', function (Blueprint $table) {
            $table->dropColumn('pdfUrl');
            $table->dropColumn('xmlUrl');
            $table->renameColumn('codigo_nf_asaas', 'codigo_nf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamento_nf', function (Blueprint $table) {
            $table->string('pdfUrl')->nullable();
            $table->string('xmlUrl')->nullable();
            $table->renameColumn('codigo_nf', 'codigo_nf_asaas');
        });
    }
}
