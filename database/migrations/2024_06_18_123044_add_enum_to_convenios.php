<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddEnumToConvenios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE convenios MODIFY vencimento_boleto enum('Todo dia 15','Todo dia 20','Todo dia 22', 'Todo dia 24', 'Todo dia 25', 'Todo dia 28', '10 dias após a emissão', '21 dias após a emissão','28 dias após a emissão','30 dias após a emissão','45 dias após a emissão','60 dias após a emissão', 'Faturamento + 30 Dias', 'Faturamento + 45 Dias', 'Dia 01 do próximo mês', 'Dia 05 do próximo mês', 'Dia 10 do próximo mês') NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE convenios MODIFY vencimento_boleto enum('Todo dia 25','Faturamento + 30 Dias','Faturamento + 45 Dias') NOT NULL;");
    }
}
