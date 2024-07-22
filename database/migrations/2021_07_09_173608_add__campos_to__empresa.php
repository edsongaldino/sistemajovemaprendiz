<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('cnpj_matriz', 14)->index()->nullable()->after('cnpj');
            $table->string('conta_contabil', 14)->nullable()->after('cei');
            $table->text('atividade_principal')->nullable()->after('nome_fantasia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('cnpj_matriz');
            $table->dropColumn('conta_contabil');
            $table->dropColumn('atividade_principal');
        });
    }
}
