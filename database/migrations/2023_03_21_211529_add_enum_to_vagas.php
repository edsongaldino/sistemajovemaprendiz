<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddEnumToVagas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vagas', function (Blueprint $table) {
            DB::statement("ALTER TABLE vagas MODIFY situacao enum('Processo Seletivo - Aberto', 'Processo Seletivo - Concluído', 'Aberta', 'Preenchida') NOT NULL;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vagas', function (Blueprint $table) {
            DB::statement("ALTER TABLE vagas MODIFY situacao enum('Preenchida', 'Processo Seletivo', 'Aberta') NOT NULL;");
        });
    }
}
