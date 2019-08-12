<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); # ID
            $table->string('name'); # NAME
            $table->string('email')->unique(); # E-MAIL
            $table->timestamp('email_verified_at')->nullable(); # E-MAIL VERIFIED AT
            $table->string('password'); # PASSWORD
            $table->string('image', 100)->nullable();

            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('data')->nullable();
            $table->string('sexo')->nullable();
            $table->string('nacionalidade')->nullable();
            $table->string('naturalidade')->nullable();
            $table->string('endereco')->nullable();
            $table->string('fone')->nullable();
            $table->string('matricula')->nullable();
            $table->string('estadocivil')->nullable();
            $table->string('conjuge')->nullable();
            $table->string('carteiradigital')->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('tipoconta')->nullable(); //(poupança física ou jurídica - conta corrente física ou jurídica)
            $table->string('titularconta')->nullable();

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
