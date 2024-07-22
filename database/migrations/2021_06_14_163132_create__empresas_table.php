<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('endereco_id')->constrained('enderecos');
            $table->enum('tipo_empresa', ['Matriz', 'Filial']);
            $table->string('cnpj',14)->unique()->index();
            $table->string('inscricao_estadual', 14)->nullable();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('telefone', 11);
            $table->string('nome_responsavel');
            $table->string('telefone_responsavel',11);
            $table->string('email_responsavel');
            $table->string('cpf_responsavel', 11);
            $table->string('rg_responsavel', 15);
            $table->string('emissor_rg_responsavel', 10);
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
        Schema::dropIfExists('empresas');
    }
}
