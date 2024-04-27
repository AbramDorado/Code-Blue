<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->bigIncrements('vital_signs_id'); 
            $table->time('vs_1st_time')->nullable();
            $table->string('blood_pressure1')->nullable();
            $table->unsignedInteger('respiratory_rate1')->nullable();
            $table->unsignedInteger('pulse_rate1')->nullable();
            $table->unsignedInteger('oxygen_sat1')->nullable();
            $table->string('skin_color1')->nullable();
            $table->string('skin_temp1')->nullable();
            $table->time('vs_2nd_time')->nullable();
            $table->string('blood_pressure2')->nullable();
            $table->unsignedInteger('respiratory_rate2')->nullable();
            $table->unsignedInteger('pulse_rate2')->nullable();
            $table->unsignedInteger('oxygen_sat2')->nullable();
            $table->string('skin_color2')->nullable();
            $table->string('skin_temp2')->nullable();
            $table->time('vs_3rd_time')->nullable();
            $table->string('blood_pressure3')->nullable();
            $table->unsignedInteger('respiratory_rate3')->nullable();
            $table->unsignedInteger('pulse_rate3')->nullable();
            $table->unsignedInteger('oxygen_sat3')->nullable();
            $table->string('skin_color3')->nullable();
            $table->string('skin_temp3')->nullable();
            $table->time('vs_4th_time')->nullable();
            $table->string('blood_pressure4')->nullable();
            $table->unsignedInteger('respiratory_rate4')->nullable();
            $table->unsignedInteger('pulse_rate4')->nullable();
            $table->unsignedInteger('oxygen_sat4')->nullable();
            $table->string('skin_color4')->nullable();
            $table->string('skin_temp4')->nullable();

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
        Schema::dropIfExists('vital_signs');
    }
}
