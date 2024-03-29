<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('trip_schedule_period_id');
            $table->unsignedBigInteger('trip_schedule_type_id');
            $table->unsignedBigInteger('trip_schedule_cancellation_model_id')->default(1);
            $table->unsignedInteger('trip_schedule_status_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('has_package')->default(0);
            $table->boolean('day_use')->default(0);
            $table->boolean('for_adults')->default(0);
            $table->tinyInteger('published')->default(1);
            $table->integer('vacancies_quantity');
            $table->integer('vacancies_filled')->default(0);
            $table->double('price');
            $table->integer('discount_percent')->default(0);
            $table->integer('purchase_limit')->default(0);
            $table->softDeletes();

            $table->timestamps();

            $table->foreign('trip_schedule_period_id')->references('id')->on('trip_schedule_periods');
            $table->foreign('trip_schedule_type_id')->references('id')->on('trip_schedule_types');
            $table->foreign('trip_schedule_cancellation_model_id')->references('id')->on('trip_schedule_cancellation_models');
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->foreign('trip_schedule_status_id')->references('id')->on('trip_schedule_status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_schedules');
    }
}
