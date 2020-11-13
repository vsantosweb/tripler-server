<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPassagerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_passager_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->string('name');
            $table->double('amount')->nullable();
            $table->timestamps();

            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_passager_types');
    }
}
