<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code', 100)->unique();
            $table->unsignedBigInteger('agency_id');
            $table->unsignedInteger('trip_status_id');
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('trip_tax_id');
            $table->string('home_dir')->nullable();

            $table->timestamps();

            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->foreign('trip_status_id')->references('id')->on('trip_status');
            $table->foreign('trip_tax_id')->references('id')->on('trip_taxes');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
