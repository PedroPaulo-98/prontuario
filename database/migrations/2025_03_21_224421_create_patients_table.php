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
            $table->string('name', 80);
            $table->string('social_name', 80)->nullable();
            $table->string('mother', 80)->nullable();
            $table->string('father', 80)->nullable();
            $table->string('breed', 80)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('sex', 11)->nullable();
            $table->char('cpf', 14)->nullable();
            $table->char('cns', 18)->nullable();
            $table->string('rg', 15)->nullable();
            $table->char('uf_rg', 2)->nullable();
            $table->string('expediter', 15)->nullable();
            $table->string('marital_status', 13)->nullable();
            $table->string('nationallity', 50)->nullable();
            $table->string('naturalness', 80)->nullable();
            $table->string('uf_naturalness', 2)->nullable();
            $table->char('phone', 15)->nullable();
            $table->char('cep', 10)->nullable();
            $table->string('street', 60)->nullable();
            $table->string('complement', 60)->nullable();
            $table->string('district', 30)->nullable();
            $table->string('city', 80)->nullable();
            $table->char('state', 2)->nullable();
            $table->boolean('death');
            $table->tinyText('cause')->nullable();
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
