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
        Schema::table('convenios', function (Blueprint $table) {
            $table->enum('possui_pedido', ['Sim', 'Não'])->default('Não')->after('tipo_envio');
            $table->enum('envia_relatorio', ['Sim', 'Não'])->default('Não')->after('tipo_envio');
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
            $table->dropColumn('possui_pedido');
            $table->dropColumn('envia_relatorio');
        });
    }
};
