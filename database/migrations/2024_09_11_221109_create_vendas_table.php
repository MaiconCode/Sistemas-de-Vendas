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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_produto');
            $table->float('valor');
            $table->float('qtda_produto');
            $table->float('subtotal');
            $table->string('forma_pagamento');
            $table->string('cliente');
            $table->integer('qtda_parcelas');
            $table->integer('id_cliente');
            $table->float('valor_parcelas');
            $table->date('data_vencimento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
