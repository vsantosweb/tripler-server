<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_features', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('trip_id');
            $table->text('metadata')->nullable();
            // $table->text('trip_includes')->nullable();
            // $table->text('boarding_locations')->nullable();
            // $table->text('itinerary')->nullable();
            // $table->text('trip_takes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_features');
    }
}
