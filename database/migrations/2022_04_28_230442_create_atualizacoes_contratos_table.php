<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtualizacoesContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atualizacoes_contrato', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->constrained('contratos');
            $table->bigInteger('user_id')->constrained('users');
            $table->enum('tipo', ['Entrega de Uniforme', 'Falta Trabalho', 'Atualização Contratual'])->default('Entrega de Uniforme');
            $table->date('data');
            $table->integer('quantidade')->default(0)->nullable();
            $table->enum('tamanho', ['PP', 'P', 'M', 'G', 'GG', 'XGG', 'XXGG'])->default('M')->nullable();
            $table->decimal('valor', 10,2)->nullable();
            $table->enum('falta_justificada', ['Sim', 'Não'])->nullable();
            $table->string('arquivo')->nullable();
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
        Schema::dropIfExists('atualizacoes_contrato');
    }
}
