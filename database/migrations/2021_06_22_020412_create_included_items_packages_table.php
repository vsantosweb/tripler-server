<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncludedItemsPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_included_items_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_package_id');
            $table->unsignedBigInteger('trip_included_item_id');

            $table->primary(['trip_package_id', 'trip_included_item_id'], 'package_primary');

            $table->foreign('trip_package_id')->references('id')->on('trip_packages');
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
        Schema::dropIfExists('trip_included_items_packages');
    }
}
