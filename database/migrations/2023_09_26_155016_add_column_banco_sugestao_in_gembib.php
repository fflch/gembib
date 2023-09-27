<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBancoSugestaoInGembib extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itens', function (Blueprint $table) {
            $table->text('tradutor')->nullable();
            $table->text('preco_editora')->nullable();
            $table->text('area')->nullable();
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
