<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContaPagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_pagars', function (Blueprint $table) {
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
            $table->unsignedBigInteger('fornecedor_id');
            $table->unsignedBigInteger('user_id');

            //foreign keys
            $table->foreign('conta_id')->references('id')->on('contas')->cascade();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->cascade();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('conta_pagars');
    }
}
