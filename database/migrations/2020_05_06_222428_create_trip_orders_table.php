<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 70)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('trip_order_status_id');
            $table->string('boarding_location')->nullable();
            $table->string('trip_name')->nullable();
            $table->string('trip_package')->nullable();
            $table->text('passengers')->nullable();
            $table->string('payment_method')->nullable();
            $table->double('total_amount');
            $table->double('tax');
            $table->date('expire_at');
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('trip_order_status_id')->references('id')->on('trip_order_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_orders');
    }
}
