<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVencimentoBoletoToConvenio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convenios', function (Blueprint $table) {
            $table->enum('vencimento_boleto', ['Todo dia 25', 'Faturamento + 30 Dias', 'Faturamento + 45 Dias'])->default('Todo dia 25')->after('dia_faturamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convenios', function (Blueprint $table) {
            $table->dropColumn('vencimento_boleto');
        });
    }
}
