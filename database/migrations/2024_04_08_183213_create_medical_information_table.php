<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_information', function (Blueprint $table) {
            $table->bigIncrements('patient_id'); 
            $table->string('full_name')->nullable();
            $table->string('contact_num_p')->nullable();
            $table->string('address_p')->nullable();
            $table->string('sex')->nullable();
            $table->integer('age')->nullable();
            $table->string('status')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('comps_name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('address_c')->nullable();
            $table->string('contact_num_c')->nullable();
            $table->string('team')->nullable();
            $table->string('plate_num')->nullable();
            $table->string('driver')->nullable();
            $table->string('reporter')->nullable();
            $table->string('cameraman')->nullable();
            $table->string('team_leader')->nullable();
            $table->string('crew1')->nullable();
            $table->string('crew2')->nullable();
            $table->string('crew3')->nullable();
            $table->string('crew4')->nullable();
            $table->time('departure_base_time')->nullable();
            $table->time('arrival_scene_time')->nullable();
            $table->time('arrival_hospital_time')->nullable();
            $table->time('departure_hospital_time')->nullable();
            $table->time('arrival_base_time')->nullable();
            $table->datetime('incident_dt')->nullable();
            $table->string('location')->nullable();
            $table->string('incident_type')->nullable();
            $table->string('incident_nature')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('medical_information');
    }
}
