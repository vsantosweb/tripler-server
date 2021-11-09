<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripRoadmapStepValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_roadmap_step_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_roadmap_step_id');
            $table->string('type')->nullable();
            $table->text('value')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('trip_roadmap_step_id')->references('id')->on('trip_roadmap_steps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_roadmap_step_values');
    }
}
