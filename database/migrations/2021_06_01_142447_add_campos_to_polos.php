<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToPolos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polos', function (Blueprint $table) {
            $table->foreignId('endereco_id')->constrained('enderecos');
            $table->string('nome')->after('endereco_id');
            $table->string('telefone')->after('nome');
            $table->string('cnpj', 14)->index()->nullable()->after('nome');
            $table->string('inscricao_estadual', 14)->nullable()->after('nome');
            $table->string('email')->after('nome');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('polos', function (Blueprint $table) {
            $table->dropColumn('endereco_id');
            $table->dropColumn('nome');
            $table->dropColumn('telefone');
            $table->dropColumn('cnpj');
            $table->dropColumn('inscricao_estadual');
            $table->dropColumn('email');
        });
    }
}
