<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToFaturamentoNF extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamento_nf', function (Blueprint $table) {
            $table->string('link_pdf')->after('status')->nullable();
            $table->string('numero_rps')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faturamento_nf', function (Blueprint $table) {
            $table->dropColumn('link_pdf');
            $table->dropColumn('numero_rps');
        });
    }
}
