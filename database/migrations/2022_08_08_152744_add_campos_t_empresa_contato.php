<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCamposTEmpresaContato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE empresa_contato MODIFY setor ENUM('RH','COMERCIAL','FINANCEIRO','RESPONSÁVEL jOVEM')");
        Schema::table('empresa_contato', function (Blueprint $table) {
            $table->string('departamento')->nullable()->after('setor');
            $table->string('cpf',11)->index()->nullable()->after('setor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE empresa_contato MODIFY setor ENUM('RH','COMERCIAL','FINANCEIRO')");
        Schema::table('empresa_contato', function (Blueprint $table) {
            $table->dropColumn('departamento');
            $table->dropColumn('cpf');
        });
    }
}
