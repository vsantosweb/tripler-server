<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripOrderItemPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_order_item_passengers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_order_item_id');
            $table->string('name');
            $table->string('rg');
            $table->string('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->double('price');
            $table->double('discount')->default(0);
            $table->double('total');
            $table->text('optionals')->nullable();
            $table->text('metadata')->nullable();

            $table->timestamps();

            $table->foreign('trip_order_item_id')->references('id')->on('trip_order_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_order_item_passengers');
    }
}
