<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCampoDadosBancariosToFaturamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->string('dados_bancarios')->after('numero_pedido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->dropColumn('dados_bancarios');
        });
    }
}
