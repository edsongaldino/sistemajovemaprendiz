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
        Schema::table('atualizacoes', function (Blueprint $table) {
            DB::statement("ALTER TABLE atualizacoes MODIFY situacao_atualizacao ENUM('Efetivada', 'Agendada')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atualizacoes', function (Blueprint $table) {
            DB::statement("ALTER TABLE atualizacoes MODIFY situacao_atualizacao ENUM('Efetivada', 'Aguardando', 'Cancelada')");
        });
    }
};
