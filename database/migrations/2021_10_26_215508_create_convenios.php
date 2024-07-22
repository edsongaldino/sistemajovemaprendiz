<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvenios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->nullable();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->integer('qtde_jovens');
            $table->date('data_inicial');
            $table->integer('dia_faturamento');
            $table->enum('situacao', ['Ativo', 'Bloqueado', 'Cancelado']);
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
        Schema::dropIfExists('convenios');
    }
}
