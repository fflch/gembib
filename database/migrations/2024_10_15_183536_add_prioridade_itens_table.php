<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('itens', function (Blueprint $table) {
            $table->boolean('prioridade_processamento')->nullable()->default(0);
            $table->text('justificativa_processamento')->nullable();
            $table->string('pedido_usuario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itens', function (Blueprint $table) {
            //
        });
    }
};
