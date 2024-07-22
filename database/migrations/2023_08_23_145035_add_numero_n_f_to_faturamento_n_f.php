<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroNFToFaturamentoNF extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_nf', function (Blueprint $table) {
            $table->string('numero_nf')->after('numero_rps')->nullable();
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
            $table->dropColumn('numero_nf');
        });
    }
}
