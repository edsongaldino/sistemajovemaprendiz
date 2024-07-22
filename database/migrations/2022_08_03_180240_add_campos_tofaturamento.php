<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposTofaturamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faturamentos', function (Blueprint $table) {
            $table->decimal('valor', 10,2)->after('data');
            $table->date('data_inicial')->after('data');
            $table->date('data_final')->after('data');
            $table->string('numero_nf')->after('data')->nullable();
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
            $table->dropColumn('data_inicial');
            $table->dropColumn('data_final');
            $table->dropColumn('valor');
            $table->dropColumn('numero_nf');
        });
    }
}
