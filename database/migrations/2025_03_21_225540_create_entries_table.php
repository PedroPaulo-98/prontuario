<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit');
            $table->unsignedBigInteger('bpa');
            $table->dateTime('entry');
            $table->unsignedBigInteger('patient');
            $table->longText('information')->nullable();
            $table->unsignedBigInteger('reason');
            $table->unsignedBigInteger('origin');
            $table->unsignedBigInteger('companion')->nullable();
            $table->boolean('ambulance');
            $table->boolean('work');
            $table->boolean('police');
            $table->boolean('mistreatment');
            $table->string('native', 5)->nullable();
            $table->longText('intercurrence')->nullable();
            $table->foreign('unit')->references('id')->on('units');
            $table->foreign('patient')->references('id')->on('patients');
            $table->foreign('companion')->references('id')->on('companions');
            $table->foreign('reason')->references('id')->on('reasons');
            $table->foreign('origin')->references('id')->on('origins');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
