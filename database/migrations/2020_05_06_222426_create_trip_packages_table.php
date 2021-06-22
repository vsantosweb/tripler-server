<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trip_accommodation_id');
            $table->string('name');
            $table->string('description');
            $table->integer('quantity');
            $table->double('amount');
            $table->tinyInteger('shared');
            $table->timestamps();

            $table->foreign('trip_accommodation_id')->references('id')->on('trip_accommodations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_packages');
    }
}
