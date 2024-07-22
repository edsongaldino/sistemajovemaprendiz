<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoqueMovimentacaosTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
    **/

    public function up()
    {
        Schema::create('estoque_movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estoque_produto_id')->constrained('estoque_produtos');
            $table->bigInteger('user_id')->constrained('users');
            $table->enum('tipo', ['Entrada', 'Saída', 'Transferência'])->default('Entrada');
            $table->dateTime('data');
            $table->integer('quantidade');
            $table->integer('polo_destino')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    **/

    public function down()
    {
        Schema::dropIfExists('estoque_movimentacoes');
    }

}