<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToFaturamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->string('numero_pedido')->after('forma_pagamento')->nullable();
        });

        Schema::table('faturamento_contrato', function (Blueprint $table) {
            $table->dropColumn('numero_pedido');
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
            $table->dropColumn('numero_pedido');
        });

    }
}
