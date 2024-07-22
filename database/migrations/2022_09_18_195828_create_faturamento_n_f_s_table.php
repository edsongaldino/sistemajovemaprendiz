<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturamentoNFSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturamento_nf', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faturamento_id')->constrained('faturamentos');
            $table->string('codigo_nf_asaas')->nullable();
            $table->string('status')->nullable();
            $table->string('pdfUrl')->nullable();
            $table->string('xmlUrl')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('faturamento_nf');
    }
}
