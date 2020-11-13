<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripBoardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_boardings', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_schedule_id');
            $table->unsignedBigInteger('trip_boarding_id');
            $table->timestamps();

            $table->primary(['trip_schedule_id','trip_boarding_id']);

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
        Schema::dropIfExists('trip_boardings');
    }
}
