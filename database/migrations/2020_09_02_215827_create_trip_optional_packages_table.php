<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripOptionalPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_optional_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agency_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('base_price')->default(0);
            $table->text('images')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_optional_packages');
    }
}
