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
        Schema::create('tipo_calendario', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->integer('qtd_aulas_adaptacao');
            $table->integer('qtd_aulas_basicas');
            $table->integer('qtd_dias_contrato');
            $table->integer('qtd_aulas_especifico');
            $table->integer('qtd_aulas_praticas');
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
        Schema::dropIfExists('tipo_calendario');
    }
};
