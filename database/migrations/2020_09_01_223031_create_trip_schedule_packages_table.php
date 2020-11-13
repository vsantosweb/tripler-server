<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripSchedulePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_schedule_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_schedule_id');
            $table->unsignedBigInteger('trip_package_id');
            $table->primary(['trip_schedule_id', 'trip_package_id']);

            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules')->onDelete('cascade');
            $table->foreign('trip_package_id')->references('id')->on('trip_packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_schedule_packages');
    }
}
