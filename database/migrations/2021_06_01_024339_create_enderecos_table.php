<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->foreignId('cidade_id')->constrained('cidades');
            $table->string('cep_endereco', 10);
            $table->string('logradouro_endereco', 100);
            $table->string('numero_endereco', 10);
            $table->string('complemento_endereco', 100);
            $table->string('bairro_endereco', 50);
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
        Schema::dropIfExists('enderecos');
    }
}
