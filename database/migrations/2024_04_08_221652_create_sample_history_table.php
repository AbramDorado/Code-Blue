<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('sample_history', function (Blueprint $table) {
        $table->bigIncrements('sample_history_id');
        $table->string('signs_symptoms')->nullable();
        $table->string('allergies')->nullable();
        $table->string('medications')->nullable();
        $table->string('past_medical_history')->nullable();
        $table->string('last_oral_intake')->nullable();
        $table->string('event_leading_to_injury')->nullable();

        $table->unsignedBigInteger('patient_id');
        // Define foreign key constraint
        $table->foreign('patient_id')->references('patient_id')->on('medical_information')->onDelete('cascade');
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
        Schema::dropIfExists('sample_history');
    }
}
