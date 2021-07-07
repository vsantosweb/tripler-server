<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripSchedulesPassagerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_schedules_passager_types', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_schedule_id');
            $table->unsignedBigInteger('trip_passager_type_id');
            $table->double('amount')->default(0);
            
            $table->primary(['trip_schedule_id', 'trip_passager_type_id'], 'schedule_to_passagers');
            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules')->onDelete('cascade');
            $table->foreign('trip_passager_type_id')->references('id')->on('trip_passager_types')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_schedules_passager_types');
    }
}
