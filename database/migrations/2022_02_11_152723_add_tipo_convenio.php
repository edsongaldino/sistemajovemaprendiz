<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoConvenio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convenios', function (Blueprint $table) {
            $table->integer('polo_id')->unsigned()->after('empresa_id'); 
            $table->integer('tabela_id')->unsigned()->after('empresa_id'); 
            $table->enum('tipo_convenio', ['Administrativo', 'Supermercado', 'Frentista'])->default('Administrativo')->after('dia_faturamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convenios', function (Blueprint $table) {
            $table->dropColumn('polo_id');
            $table->dropColumn('tabela_id');
            $table->dropColumn('tipo_convenio');
        });
    }
}
