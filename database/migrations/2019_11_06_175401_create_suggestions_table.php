<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
			$table->string('autor',2048);
			$table->string('titulo',2048);
			$table->string('editora',2048)->nullable();

			/* quando uma sugestão for negada, colocamos o motivo*/
			$table->string('motivo',2048)->nullable();
			$table->string('status',2048);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggestions');
    }
}
