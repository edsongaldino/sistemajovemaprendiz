<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoqueProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estoque_id')->constrained('estoques');
            $table->string('nome');
            $table->string('descricao');
            $table->enum('tipo', ['Uniforme', 'Materiais de Escritório', 'Materiais de Limpeza', 'Suprimentos'])->default('Suprimentos');
            $table->string('categoria')->nullable();
            $table->enum('tamanho_uniforme', ['PP', 'P', 'M', 'G', 'GG', 'XGG', 'XXGG'])->default('M')->nullable();
            $table->integer('quantidade')->default(0);
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
        Schema::dropIfExists('estoque_produtos');
    }
}
