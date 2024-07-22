<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('polo_id')->constrained('polos');
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->enum('tipo_vaga', ['Administrativo', 'Frentista'])->default('Administrativo');
            $table->integer('qtde_vagas');
            $table->date('data_inicial');
            $table->enum('situacao', ['Preenchida', 'Processo Seletivo', 'Aberta'])->default('Aberta');
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
        Schema::dropIfExists('vagas');
    }
}
