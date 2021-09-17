<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->unsignedBigInteger('agency_id');

            $table->uuid('uuid')->unique();
            $table->string('session_id', 100)->unique();
            $table->text('cart_data')->nullable();
            $table->text('package')->nullable();
            $table->boolean('is_package')->default(0);
            $table->text('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules');
            $table->foreign('agency_id')->references('id')->on('agencies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_carts');
    }
}
