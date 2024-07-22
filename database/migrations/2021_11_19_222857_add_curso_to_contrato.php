<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCursoToContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->bigInteger('curso_id')->constrained('cursos')->after('tabela_id');
            $table->enum('periodo_teorico', ['Manhã', 'Tarde', 'Noite'])->default('Tarde')->after('data_final');
            $table->enum('periodo_pratico', ['Manhã', 'Tarde', 'Noite'])->default('Tarde')->after('data_final');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('curso_id');
            $table->dropColumn('periodo_teorico');
            $table->dropColumn('periodo_pratico');
        });
    }
}
