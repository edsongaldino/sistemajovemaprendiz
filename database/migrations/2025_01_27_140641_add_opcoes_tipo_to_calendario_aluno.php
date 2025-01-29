<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('calendario_aluno', function (Blueprint $table) {
            DB::statement("ALTER TABLE calendario_aluno MODIFY tipo ENUM('Adaptação', 'Básico', 'Prática', 'Específico', 'Férias', 'Feriado')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendario_aluno', function (Blueprint $table) {
            DB::statement("ALTER TABLE calendario_aluno MODIFY tipo ENUM('Adaptação', 'Básico', 'Prática', 'Específico')");
        });
    }
};
