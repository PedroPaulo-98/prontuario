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
        Schema::create('companions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient');
            $table->string('name', 80);
            $table->char('cpf', 14)->nullable();
            $table->char('phone', 15)->nullable();
            $table->string('kinship', 17);
            $table->boolean('active');
            $table->foreign('patient')->references('id')->on('patients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companions');
    }
};
