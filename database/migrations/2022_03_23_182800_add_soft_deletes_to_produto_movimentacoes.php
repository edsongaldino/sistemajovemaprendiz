<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToProdutoMovimentacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estoque_movimentacoes', function (Blueprint $table) {
            $table->string('descricao',100)->after('quantidade');
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
        Schema::table('estoque_movimentacoes', function (Blueprint $table) {
            $table->dropColumn('descricao');
            $table->dropSoftDeletes();
        });
    }
}
