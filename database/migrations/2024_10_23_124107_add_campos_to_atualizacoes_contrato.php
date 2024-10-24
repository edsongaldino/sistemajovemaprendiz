<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atualizacoes_contrato', function (Blueprint $table) {
            $table->bigInteger('faturamento_contrato_id')->constrained('faturamento_contrato')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atualizacoes_contrato', function (Blueprint $table) {
            $table->dropColumn('faturamento_contrato_id');
        });
    }
};
