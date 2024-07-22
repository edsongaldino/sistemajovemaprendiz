<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtuacaoComercial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atuacao_comercial', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users');
            $table->integer('contrato_id')->constrained('contratos');
            $table->decimal('comissao', 10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atuacao_comercial');
    }
}
