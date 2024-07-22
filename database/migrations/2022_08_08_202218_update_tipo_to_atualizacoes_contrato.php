<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateTipoToAtualizacoesContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE atualizacoes_contrato MODIFY tipo ENUM('Entrega de Uniforme','Falta Trabalho','Atualização Contratual','Exame Admissional','Exame Demissional')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE atualizacoes_contrato MODIFY tipo ENUM('Entrega de Uniforme','Falta Trabalho','Atualização Contratual')");
    }
}
