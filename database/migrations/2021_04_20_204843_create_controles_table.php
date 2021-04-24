<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Campos da tela de preenchimento
            $table->date('inicio')->nullable();
            $table->date('fim')->nullable();
            $table->integer('titulos_novos')->nullable();
            $table->integer('volumes')->nullable();
            $table->integer('consistencia_acervo')->nullable();
            $table->integer('outro_material')->nullable();
            $table->integer('multimeios')->nullable();
            $table->integer('servicos_tecnicos')->nullable();
            $table->integer('remocoes_acervo')->nullable();
            $table->text('observacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controles');
    }
}
