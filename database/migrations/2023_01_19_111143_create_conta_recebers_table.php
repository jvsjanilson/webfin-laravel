<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContaRecebersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_recebers', function (Blueprint $table) {
            $table->id();
            $table->string('documento',30);
            $table->date('emissao');
            $table->date('vencimento');
            $table->decimal('valor', 15,2)->default(0);
            $table->decimal('desconto', 15,2)->nullable()->default(0);
            $table->decimal('juros', 15,2)->nullable()->default(0);
            $table->decimal('multa', 15,2)->nullable()->default(0);
            $table->date('data_pagamento')->nullable();
            $table->unsignedBigInteger('conta_id');
            $table->unsignedBigInteger('cliente_id');

            //foreign keys
            $table->foreign('conta_id')->references('id')->on('contas')->cascade();
            $table->foreign('cliente_id')->references('id')->on('clientes')->cascade();

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
        Schema::dropIfExists('conta_recebers');
    }
}
