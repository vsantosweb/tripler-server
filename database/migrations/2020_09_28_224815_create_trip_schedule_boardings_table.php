<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripScheduleBoardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_schedule_boardings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->unsignedBigInteger('trip_boarding_id');
            $table->time('departure_time');

            $table->timestamps();


            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules')->onDelete('cascade');
            $table->foreign('trip_boarding_id')->references('id')->on('trip_boarding_locations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_schedule_boardings');
    }
}
