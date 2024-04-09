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
        $table->id();
        $table->unsignedBigInteger('patient_id');
        $table->text('signs_symptoms')->nullable();
        $table->text('allergies')->nullable();
        $table->text('medications')->nullable();
        $table->text('past_medical_history')->nullable();
        $table->timestamp('last_oral_intake')->nullable();
        $table->text('event_leading_to_injury')->nullable();
        $table->timestamps();

        // Define foreign key constraint
        $table->foreign('patient_id')->references('patient_id')->on('medical_information')->onDelete('cascade');
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
