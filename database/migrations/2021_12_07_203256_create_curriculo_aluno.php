<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculoAluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculo_aluno', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos');
            $table->enum('sexo', ['Masculino', 'Feminino']);
            $table->enum('possui_ctps', ['Sim', 'Não'])->default('Não');
            $table->string('ctps')->nullable();
            $table->string('serie_ctps')->nullable();
            $table->enum('aluno_matriculado', ['Sim', 'Não'])->default('Não');
            $table->enum('problema_saude', ['Sim', 'Não'])->default('Não');
            $table->string('problema_saude_especificacao')->nullable();
            $table->enum('remedio_controlado', ['Sim', 'Não'])->default('Não');
            $table->string('remedio_controlado_especificacao')->nullable();
            $table->enum('tipo_moradia', ['Própria', 'Cedida', 'Alugada'])->default('Própria');
            $table->integer('numero_pessoas_residencia')->nullable();
            $table->decimal('renda_familiar', 10,2);
            $table->enum('curso_informatica', ['Sim', 'Não'])->default('Não');
            $table->string('descricao_curso')->nullable();
            $table->enum('ja_trabalhou', ['Sim', 'Não'])->default('Não');
            $table->string('funcao_exercida')->nullable();
            $table->string('empresa_trabalho')->nullable();
            $table->text('porque_decidiu_trabalhar')->nullable();
            $table->text('oque_espera_empresa')->nullable();
            $table->text('seu_sonho')->nullable();
            $table->text('ponto_forte_desenvolver')->nullable();
            $table->text('momentos_lazer')->nullable();
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
        Schema::dropIfExists('curriculo_aluno');
    }
}
