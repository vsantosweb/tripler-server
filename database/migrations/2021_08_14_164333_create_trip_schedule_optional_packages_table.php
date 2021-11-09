<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripScheduleOptionalPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_schedule_optional_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_schedule_id');
            $table->unsignedBigInteger('trip_optional_package_id');
            $table->double('price');
            $table->double('quantity');
            
            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules')->onDelete('cascade');
            $table->foreign('trip_optional_package_id')->references('id')->on('trip_optional_packages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_schedule_optional_packages');
    }
}
