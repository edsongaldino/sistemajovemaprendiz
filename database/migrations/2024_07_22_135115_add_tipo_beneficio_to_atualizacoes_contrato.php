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
            $table->string('tipo_beneficio')->after('motivo_desligamento')->nullable();
            DB::statement("ALTER TABLE atualizacoes_contrato MODIFY tipo ENUM('Entrega de Uniforme','Falta Trabalho','Atualização Contratual','Exame Admissional','Exame Demissional', 'Benefícios')");
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
            $table->dropColumn('tipo_beneficio');
            DB::statement("ALTER TABLE atualizacoes_contrato MODIFY tipo ENUM('Entrega de Uniforme','Falta Trabalho','Atualização Contratual','Exame Admissional','Exame Demissional')");
        });
    }
};
