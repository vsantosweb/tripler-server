<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingItemOptionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_item_optionals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('booking_item_id');
            $table->unsignedBigInteger('optional_id');
            $table->string('name');
            $table->double('amount');
            $table->timestamps();
            
            $table->foreign('booking_item_id')->references('id')->on('booking_items')->onDelete('cascade');
            $table->foreign('optional_id')->references('id')->on('trip_schedule_optional_packages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_item_optionals');
    }
}
