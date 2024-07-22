<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{

    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('polo_id')->constrained('polos');
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('aluno_id')->constrained('alunos');
            $table->foreignId('tabela_id')->constrained('tabelas');
            $table->date('data_inicial');
            $table->date('data_final');
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
        Schema::dropIfExists('contratos');
    }
}
