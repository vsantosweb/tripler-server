<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripIncludedItemsAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_included_items_accommodations', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_accommodation_id');
            $table->unsignedBigInteger('trip_included_item_id');

            $table->primary(['trip_accommodation_id', 'trip_included_item_id'], 'accomodation_primary');

            $table->foreign('trip_accommodation_id')->references('id')->on('trip_accommodations');
            $table->foreign('trip_included_item_id')->references('id')->on('trip_included_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_included_items_accommodations');
    }
}
