<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValorPagoToFaturamentoBoletos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_boletos', function (Blueprint $table) {
            $table->decimal('valor_juros', 10,2)->after('valor')->nullable();
            $table->decimal('valor_pago', 10,2)->after('valor')->nullable();
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
            $table->dropColumn('valor_juros');
            $table->dropColumn('valor_pago');
        });
    }
}
