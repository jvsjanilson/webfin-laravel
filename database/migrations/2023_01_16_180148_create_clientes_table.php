<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome',60)->nullable()->default('');
            $table->string('nome_fantasia',60)->nullable()->default('');
            $table->string('cpfcnpj',14)->nullable()->default('');
            $table->string('logradouro',60)->nullable()->default('');
            $table->string('numero',30)->nullable()->default('');
            $table->string('cep',8)->nullable()->default('');
            $table->string('complemento',60)->nullable()->default('');
            $table->string('bairro',60)->nullable()->default('');

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados')->cascade();

            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')->references('id')->on('cidades')->cascade();

            $table->string('fone',20)->nullable()->default('');
            $table->string('celular',20)->nullable()->default('');
            $table->string('email')->nullable()->default('');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('ativo')->nullable()->default(1);




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
        Schema::dropIfExists('clientes');
    }
}
