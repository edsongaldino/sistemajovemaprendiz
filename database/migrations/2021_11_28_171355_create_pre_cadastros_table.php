<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreCadastrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_cadastros', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_cadastro', ['Jovem', 'Empresa'])->default('Jovem');
            $table->string('nome_razao', 150);
            $table->string('cpf_cnpj', 20);
            $table->string('email',150);
            $table->string('telefone', 20);
            $table->string('responsavel', 150)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->enum('situacao', ['Finalizado','Aguardando'])->default('Aguardando');
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
        Schema::dropIfExists('pre_cadastros');
    }
}
