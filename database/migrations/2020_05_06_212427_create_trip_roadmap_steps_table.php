<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripRoadmapStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_roadmap_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_roadmap_id');
            $table->string('type')->nullable();
            $table->date('event_date')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('trip_roadmap_id')->references('id')->on('trip_roadmaps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_roadmap_steps');
    }
}
