<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_cadastro_jovens', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->date('data_nascimento');
            $table->string('email', 150);
            $table->string('periodo_estudo', 20);
            $table->string('whatsapp', 20);
            $table->string('sexo', 20);
            $table->string('cep', 10)->nullable();
            $table->string('estado', 2);
            $table->string('cidade', 100);
            $table->string('bairro', 100)->nullable();
            $table->string('situacao', 20);
            $table->dateTime('envio_email')->nullable();
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
        Schema::dropIfExists('pre_cadastro_jovens');
    }
};
