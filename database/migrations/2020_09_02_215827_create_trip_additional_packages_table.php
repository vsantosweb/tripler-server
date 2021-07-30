<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripAdditionalPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_additional_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->text('description')->nullable();
            $table->double('amount')->default(0);
            $table->string('image_url')->nullable();
            $table->string('home_dir')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_additional_packages');
    }
}
