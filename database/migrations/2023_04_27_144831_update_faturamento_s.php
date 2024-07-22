<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFaturamentoS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->bigInteger('convenio_id')->constrained('convenios')->after('id');
            $table->dropForeign('faturamentos_contrato_id_foreign');
            $table->dropColumn('contrato_id');
            $table->dropColumn('numero_nf');
            $table->dropColumn('valor');
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
