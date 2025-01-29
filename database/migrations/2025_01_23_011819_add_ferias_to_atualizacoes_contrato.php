<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('atualizacoes_contrato', function (Blueprint $table) {
            $table->date('data_inicial')->after('quantidade')->nullable();
            $table->date('data_final')->after('quantidade')->nullable();
            DB::statement("ALTER TABLE atualizacoes_contrato MODIFY tipo ENUM('Entrega de Uniforme','Falta Trabalho','Atualização Contratual','Exame Admissional','Exame Demissional', 'Benefícios', 'Alteração Salarial', 'Férias')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atualizacoes_contrato', function (Blueprint $table) {
            $table->dropColumn('data_inicial');
            $table->dropColumn('data_final');
            DB::statement("ALTER TABLE atualizacoes_contrato MODIFY tipo ENUM('Entrega de Uniforme','Falta Trabalho','Atualização Contratual','Exame Admissional','Exame Demissional', 'Benefícios', 'Alteração Salarial')");
        });
    }
};
