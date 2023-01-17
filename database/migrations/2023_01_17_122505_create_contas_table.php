<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_banco',3)->nullable();
            $table->string('numero_agencia',15)->nullable();
            $table->string('numero_conta',30)->nullable();
            $table->tinyInteger('tipo_conta')->nullable()->default(1); //1-conta corrente, 2-conta poupança
            $table->date('data_abertura')->nullable();
            $table->decimal('saldo',15,2)->nullable()->default(0);
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
        Schema::dropIfExists('contas');
    }
}
