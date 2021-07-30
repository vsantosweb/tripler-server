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
            $table->unsignedBigInteger('trip_order_id');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->double('price');
            $table->integer('quantity')->default(1);
            $table->double('discount')->default(0);
            $table->double('total')->default(0);
            $table->integer('reward')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trip_order_id')->references('id')->on('trip_orders')->onDelete('cascade');
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
