<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripOrderTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_order_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 70)->unique();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('trip_order_id');
            $table->string('ip')->nullable();
            $table->string('geo_location')->nullable();
            $table->string('user_agent')->nullable();
            $table->text('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('trip_order_id')->references('id')->on('trip_orders');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_order_transactions');
    }
}
