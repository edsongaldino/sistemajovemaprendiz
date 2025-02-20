<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateCampoTipoConvenio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE convenios MODIFY tipo_convenio enum('Administrativo','Supermercado','Frentista', 'Produção') NOT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE convenios MODIFY tipo_convenio enum('Administrativo','Supermercado','Frentista') NOT NULL;");
    }
}
