<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)->unique();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->text('trip_package')->nullable();
            $table->text('boarding_location')->nullable();
            $table->text('passagers')->nullable();
            $table->double('price');
            $table->text('metadata')->nullable();
            $table->double('discount')->default(0);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('trip_orders')->onDelete('cascade');
            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_order_items');
    }
}