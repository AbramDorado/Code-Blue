<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelOfConsciousnessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_of_consciousness', function (Blueprint $table) {
            $table->bigIncrements('level_of_consciousness_id'); 
            $table->time('loc_baseline_time')->nullable();
            $table->string('status_baseline')->nullable();
            $table->time('loc_2nd_time')->nullable();
            $table->string('status2')->nullable();
            $table->time('loc_3rd_time')->nullable();
            $table->string('status3')->nullable();
            $table->time('loc_4th_time')->nullable();
            $table->string('status4')->nullable();

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
        Schema::dropIfExists('level_of_consciousness');
    }
}
