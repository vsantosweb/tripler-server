<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_processes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('code');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->tinyInteger('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('has_finished')->default(0);
            $table->text('trip_metadata')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_processes');
    }
}
