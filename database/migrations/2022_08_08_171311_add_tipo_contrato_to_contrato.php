<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoContratoToContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->bigInteger('empresa_contato_id')->constrained('empresa_contato')->after('empresa_id');
            $table->enum('tipo_faturamento', ['Empresa', 'Instituição'])->default('Empresa')->after('convenio_id')->index();
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
            $table->dropColumn('empresa_contato_id');
            $table->dropColumn('tipo_faturamento');
        });
    }
}
