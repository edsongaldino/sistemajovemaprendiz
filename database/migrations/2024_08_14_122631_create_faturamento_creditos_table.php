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
        Schema::create('faturamento_credito', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('faturamento_id')->constrained('faturamentos');
            $table->bigInteger('user_id')->constrained('users');
            $table->decimal('valor_credito', 10,2);
            $table->string('descricao_credito')->nullable();
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
        Schema::dropIfExists('faturamento_creditos');
    }
};
