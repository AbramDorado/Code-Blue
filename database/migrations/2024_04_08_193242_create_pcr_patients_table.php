<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcrPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcr_patients', function (Blueprint $table) {
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
        Schema::dropIfExists('pcr_patients');
    }
}
