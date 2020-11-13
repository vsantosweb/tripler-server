<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_order_history', function (Blueprint $table) {
            $table->string('code');
            $table->string('customer_uid');
            $table->string('trip_schedule_uid');
            $table->string('trip_order_status');
            $table->string('customer_name');
            $table->string('customer_cpf');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('agency_name');
            $table->string('agency_uid');
            $table->string('agency_email');
            $table->decimal('amount', 8, 2);
            $table->string('payment_method');
            $table->string('boarding_location');
            $table->date('expired_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_order_history');
    }
}
