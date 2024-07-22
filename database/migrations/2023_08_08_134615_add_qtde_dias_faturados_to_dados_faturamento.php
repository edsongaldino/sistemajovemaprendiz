<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQtdeDiasFaturadosToDadosFaturamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_contrato', function (Blueprint $table) {
            $table->integer('quantidade_dias')->after('valor');
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
            $table->dropColumn('quantidade_dias');
        });
    }
}
