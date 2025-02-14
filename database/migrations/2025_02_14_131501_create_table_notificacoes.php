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
        Schema::create('notificacoes_faturamento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faturamento_id')->constrained('faturamentos');
            $table->enum('tipo_notificacao', ['Emissão','Vencimento','Atraso','Pagamento']);
            $table->string('email');
            $table->date('data_envio');
            $table->date('data_visualizacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacoes');
    }
};
