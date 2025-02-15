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
        Schema::create('notificacoes_sistema', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_notificacao', ['Faturamento','Relatório','Nota Fiscal','Boleto']);
            $table->enum('situacao', ['Criada','Resolvida']);
            $table->string('descricao');
            $table->string('email');
            $table->date('data_envio');
            $table->integer('user_validacao')->nullable();
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
        Schema::dropIfExists('notificacoes_sistema');
    }
};
