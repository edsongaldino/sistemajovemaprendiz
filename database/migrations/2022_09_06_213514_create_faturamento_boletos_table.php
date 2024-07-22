<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturamentoBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturamento_boletos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faturamento_id')->constrained('faturamentos');
            $table->date('data_vencimento');
            $table->date('data_pagamento');
            $table->string('codigo_boleto_asaas')->nullable();
            $table->string('status')->nullable();
            $table->string('invoiceUrl')->nullable();
            $table->string('bankSlipUrl')->nullable();
            $table->decimal('valor',10,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faturamento_boletos');
    }
}
