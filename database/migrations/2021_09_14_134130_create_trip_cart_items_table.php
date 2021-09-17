<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_cart_id');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->integer('quantity');
            $table->double('price');
            $table->double('total');
            $table->double('discount')->default(0);
            $table->text('metadata');
            $table->timestamps();

            $table->foreign('trip_cart_id')->references('id')->on('trip_carts')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_cart_items');
    }
}
