<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToAlunos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->bigInteger('polo_id')->constrained('polos');
            $table->bigInteger('user_id')->constrained('users');
            $table->string('rg')->after('cpf');
            $table->string('orgao_expedidor')->after('rg');
            $table->enum('sexo', ['Feminino', 'Masculino'])->after('orgao_expedidor');
            $table->string('whatsapp', 11)->after('telefone');
            $table->enum('estado_civil', ['Solteiro', 'Casado', 'Separado', 'Divorciado', 'Viúvo'])->after('sexo');
            $table->enum('escolaridade', ['Ensino Médio (Cursando)', 'Ensino Médio (Completo)', 'Superior (Cursando)', 'Superior (Completo)'])->after('estado_civil');
            $table->enum('turno', ['Matutino', 'Vespertino', 'Noturno'])->after('escolaridade');
            $table->enum('contra_turno', ['Sim', 'Não'])->after('turno');
            $table->enum('situacao', ['Ativo', 'Inativo'])->default('Ativo')->after('contra_turno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('polo_id');
            $table->dropColumn('escolaridade');
            $table->dropColumn('turno');
            $table->dropColumn('contra_turno');
        });
    }
}
