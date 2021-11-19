<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('passenger_type_id');
            $table->unsignedBigInteger('boarding_location_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('document')->nullable();;
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->double('price_fee')->default(0);
            $table->double('total_amount')->default(0);
            $table->timestamps();

            $table->foreign('boarding_location_id')->references('id')->on('trip_schedule_boardings');
            $table->foreign('passenger_type_id')->references('id')->on('trip_schedule_passenger_types');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_items');
    }
}
