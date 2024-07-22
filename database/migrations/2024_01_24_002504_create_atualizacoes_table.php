<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtualizacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atualizacoes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->constrained('users');
            $table->enum('tipo_atualizacao', ['Acréscimo', 'Decréscimo'])->default('Acréscimo');
            $table->enum('modulo_atualizacao', ['Tabela', 'Salário'])->default('Tabela');
            $table->decimal('percentual_atualizacao', 10,2);
            $table->date('data_atualizacao');
            $table->enum('situacao_atualizacao', ['Efetivada', 'Aguardando', 'Cancelada'])->default('Aguardando');
            $table->string('motivo_atualizacao');
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
        Schema::dropIfExists('atualizacoes');
    }
}
