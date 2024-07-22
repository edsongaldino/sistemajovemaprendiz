<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCamposEscolaridadeToAlunos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        DB::statement("ALTER TABLE alunos MODIFY escolaridade enum('Ensino Fundamental (Cursando)', 'Ensino Fundamental (Completo)', 'Ensino Médio (Cursando)', 'Ensino Médio (Completo)', 'Superior (Cursando)', 'Superior (Completo)') NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE alunos MODIFY escolaridade enum('Ensino Médio (Cursando)', 'Ensino Médio (Completo)', 'Superior (Cursando)', 'Superior (Completo)') NOT NULL;");
    }
}
