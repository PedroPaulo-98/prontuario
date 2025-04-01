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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);# Nome
            $table->string('social_name', 80)->nullable();#Nome Social
            $table->string('breed', 80)->nullable();#Raça
            $table->date('birth_date')->nullable();#data de aniversário
            $table->string('sex', 11)->nullable();#Sexo
            $table->char('cpf', 14)->nullable();#CPF
            $table->char('cns', 18)->nullable();#CNS
            $table->string('rg', 15)->nullable();#RG
            $table->char('uf_rg', 2)->nullable();#Unidade federativa do RG
            $table->string('expediter', 15)->nullable();#despachante
            $table->string('marital_status', 13)->nullable();#Estado Civil
            $table->string('nationallity', 50)->nullable();#Nacionalidade
            $table->string('naturalness', 80)->nullable();#Naturalidade
            $table->string('uf_naturalness', 2)->nullable();#UF Naturalidade
            $table->char('phone', 15)->nullable();#Celular
            $table->char('cep', 10)->nullable();#CEP
            $table->string('street', 60)->nullable();
            $table->string('complement', 60)->nullable();
            $table->string('district', 30)->nullable();
            $table->string('city', 80)->nullable();
            $table->char('state', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
