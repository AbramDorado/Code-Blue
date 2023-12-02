<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialResuscitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initial_resuscitations', function (Blueprint $table) {
            $table->bigIncrements('initial_resuscitation_id'); 
            $table->string('breathing_upon_ca')->nullable();
            $table->dateTime('first_ventilation_dt')->nullable();
            $table->string('ventilation')->nullable();
            $table->text('other_ventilation')->nullable();
            $table->dateTime('intubation_dt')->nullable();
            $table->unsignedInteger('et_tube_size')->nullable();
            $table->unsignedInteger('intubation_attempts')->nullable();
            $table->json('et_tube_information')->nullable();
            $table->text('first_documented_rhythm_dt')->nullable();
            $table->dateTime('first_pulseless_rhythm_dt')->nullable();
            $table->dateTime('compressions_dt')->nullable();
            $table->string('aed_applied')->nullable();
            $table->dateTime('aed_applied_dt')->nullable();
            $table->string('pacemaker_on')->nullable();
            $table->dateTime('pacemaker_on_dt')->nullable();
            
            $table->boolean('is_archived')->default(false);
            $table->unsignedBigInteger('code_number')->nullable();

            $table->foreign('code_number')->references('code_number')->on('code_blue_activations')->onDelete('cascade'); // This line adds ON DELETE CASCADE
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
        Schema::dropIfExists('initial_resuscitations');
    }
}
