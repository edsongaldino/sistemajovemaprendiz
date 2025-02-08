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
        Schema::table('convenios', function (Blueprint $table) {
            $table->enum('tipo_envio', ['Simples (Individual)', 'Aglutinado (Matriz)'])->default('Simples (Individual)')->after('percentual_issqn');
            $table->enum('tipo_emissao_cobranca', ['Simples (Individual)', 'Aglutinado (Matriz)'])->default('Simples (Individual)')->after('percentual_issqn');
            $table->enum('tipo_emissao_nf', ['Simples (Individual)', 'Aglutinado (Matriz)'])->default('Simples (Individual)')->after('percentual_issqn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convenios', function (Blueprint $table) {
            $table->dropColumn('tipo_envio');
            $table->dropColumn('tipo_emissao_cobranca');
            $table->dropColumn('tipo_emissao_nf');
        });
    }
};
