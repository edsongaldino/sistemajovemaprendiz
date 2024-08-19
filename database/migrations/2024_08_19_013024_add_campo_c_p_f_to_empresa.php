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
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('cpf')->after('cnpj')->nullable();
            DB::statement("ALTER TABLE empresas MODIFY tipo_cadastro ENUM('CNPJ', 'CPF')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('cpf');
            DB::statement("ALTER TABLE empresas MODIFY tipo_cadastro ENUM('CNPJ', 'CEI')");
        });
    }
};
