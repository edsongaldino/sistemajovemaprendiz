<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('polo_id')->constrained('polos');
            $table->string('numero');
            $table->string('nome');
            $table->string('funcao');
            $table->string('cbo');
            $table->integer('ch_total');
            $table->integer('ch_pratica');
            $table->integer('ch_teorica');
            $table->integer('ch_semanal');
            $table->integer('ch_diaria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
