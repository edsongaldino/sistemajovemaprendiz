<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToPolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('polos', function (Blueprint $table) {
            $table->foreignId('regiao_id')->constrained('regioes');
            $table->enum('tipo_polo', ['Administrativo', 'Educacional', 'Administrativo e Educacional']);
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
            $table->dropColumn('regiao_id');
            $table->dropColumn('tipo_polo');
        });
    }
}
