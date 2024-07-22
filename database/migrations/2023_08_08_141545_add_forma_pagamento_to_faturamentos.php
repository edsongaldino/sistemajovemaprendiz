<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormaPagamentoToFaturamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->enum('forma_pagamento', ['Boleto', 'Depósito'])->default('Boleto')->after('convenio_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->dropColumn('forma_pagamento');
        });
    }
}
