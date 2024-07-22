<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtualizacoesTabela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atualizacoes_tabela', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('atualizacao_id')->constrained('atualizacoes');
            $table->bigInteger('tabela_id')->constrained('tabelas');
            $table->decimal('valor_atual', 10,2);
            $table->decimal('novo_valor', 10,2);
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
        Schema::dropIfExists('atualizacoes_tabela');
    }
}
