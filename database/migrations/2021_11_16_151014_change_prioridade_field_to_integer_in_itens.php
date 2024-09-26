<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class ChangePrioridadeFieldToIntegerInItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(" UPDATE itens SET tipo_aquisicao='Doação' WHERE tipo_aquisicao='Retombamento' ");
        DB::statement(" UPDATE itens SET prioridade='0' WHERE prioridade='Coleção Didática' ");
        DB::statement(" UPDATE itens SET prioridade=NULL WHERE prioridade='' ");
        DB::statement(" UPDATE itens SET created_at='2021-11-16 15:00:00' WHERE created_at='0000-00-00 00:00:00' ");
        DB::statement(" UPDATE itens SET updated_at='2021-11-16 15:00:00' WHERE updated_at='0000-00-00 00:00:00' ");
        DB::statement(" UPDATE itens SET data_sugestao='2021-11-16' WHERE data_sugestao='0000-00-00' ");
        DB::statement(" UPDATE itens SET data_tombamento='2021-11-16' WHERE data_tombamento='0000-00-00' ");



        Schema::table('itens', function (Blueprint $table) {
            $table->integer('prioridade')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itens', function (Blueprint $table) {
            //
        });
    }
}
