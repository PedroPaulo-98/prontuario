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
            $table->unsignedBigInteger('bpa');
            $table->unsignedBigInteger('unit_id');
            $table->dateTime('entry');
            $table->unsignedBigInteger('patient_id');
            $table->longText('information')->nullable();
            $table->unsignedBigInteger('reason_id');
            $table->unsignedBigInteger('origin_id');
            $table->unsignedBigInteger('companion_id')->nullable();
            $table->boolean('ambulance');
            $table->boolean('work');
            $table->boolean('police');
            $table->boolean('mistreatment');
            $table->string('native', 5)->nullable();
            $table->longText('intercurrence')->nullable();
            
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('companion_id')->references('id')->on('companions');
            $table->foreign('reason_id')->references('id')->on('reasons');
            $table->foreign('origin_id')->references('id')->on('origins');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
