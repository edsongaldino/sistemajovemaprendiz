<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFaturamentoContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_contrato', function (Blueprint $table) {
            $table->foreignId('faturamento_id')->constrained('faturamentos')->after('id');
            $table->dropForeign('faturamento_contrato_convenio_id_foreign');
            $table->dropColumn('convenio_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
