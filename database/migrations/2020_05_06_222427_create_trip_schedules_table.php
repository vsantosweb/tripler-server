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
            $table->string('code', 100)->unique()->default(sha1(now().uniqid()));
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('trip_category_id');
            $table->unsignedInteger('trip_schedule_status_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('only_day');
            $table->tinyInteger('published')->default(1);
            $table->integer('vacancies_quantity');
            $table->integer('vacancies_filled')->default(0);
            $table->double('price');
            $table->integer('discount_percent')->default(0);
            $table->integer('purchase_limit')->default(0);

            $table->timestamps();

            $table->foreign('trip_category_id')->references('id')->on('trip_categories');
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
