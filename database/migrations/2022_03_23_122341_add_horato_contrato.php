<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHoratoContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {

            $table->time('hora_inicial_teorico')->default('00:00')->after('periodo_teorico');
            $table->time('hora_final_teorico')->default('00:00')->after('periodo_teorico');
            $table->time('hora_inicial_pratico')->default('00:00')->after('periodo_pratico');
            $table->time('hora_final_pratico')->default('00:00')->after('periodo_pratico');

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
            $table->dropColumn('hora_inicial_teorico');
            $table->dropColumn('hora_final_teorico');
            $table->dropColumn('hora_inicial_pratico');
            $table->dropColumn('hora_final_pratico');
        });
    }
}
