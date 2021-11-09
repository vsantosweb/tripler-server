<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripRequirementItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_requirement_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_requirement_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('allowed')->default(1);
            $table->timestamps();

            $table->foreign('trip_requirement_id')->references('id')->on('trip_requirements')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_requirement_items');
    }
}
