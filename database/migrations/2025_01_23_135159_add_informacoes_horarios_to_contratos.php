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
        Schema::table('contratos', function (Blueprint $table) {
            $table->time('hora_final_especifico')->nullable()->after('hora_inicial_teorico');
            $table->time('hora_inicial_especifico')->nullable()->after('hora_inicial_teorico');
            $table->enum('periodo_especifico', ['Manhã', 'Tarde', 'Noite'])->nullable()->after('hora_inicial_teorico');
            $table->enum('dia_semana_especifico', ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira'])->after('hora_inicial_teorico')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('dia_semana_especifico');
            $table->dropColumn('periodo_especifico');
            $table->dropColumn('hora_inicial_especifico');
            $table->dropColumn('hora_final_especifico');
        });
    }
};
