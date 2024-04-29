<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHTAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_t_assessment', function (Blueprint $table) {
            $table->bigIncrements('h_t_assessment_id'); 
            $table->string('head')->nullable();
            $table->string('shoulders')->nullable();
            $table->string('arms')->nullable();
            $table->string('body')->nullable();
            $table->string('legs')->nullable();
            $table->string('toes')->nullable();

            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('medical_information')->onDelete('cascade'); // This line adds ON DELETE CASCADE
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
        Schema::dropIfExists('h_t_assessment');
    }
}
