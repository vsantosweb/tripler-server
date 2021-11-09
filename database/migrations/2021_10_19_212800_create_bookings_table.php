<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 70)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('trip_schedule_id');
            $table->tinyInteger('status')->default(3)->comment('0 CANCELED | 1 PAID | 2 PROCESSING | 3 OPPENED ');
            $table->boolean('is_package');
            $table->timestamp('check_in_date')->nullable();
            $table->timestamp('check_out_date')->nullable();
            $table->timestamp('booking_date')->nullable();
            $table->timestamp('cancel_date')->nullable();
            $table->double('commission_fee')->default(0);
            $table->integer('quantity');
            $table->double('unit_price');
            $table->double('total')->default(0);
            $table->double('amount_paid')->default(0);
            $table->boolean('is_refund')->default(0);
            $table->double('refund_paid')->default(0);
            $table->timestamp('expire_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->foreign('trip_schedule_id')->references('id')->on('trip_schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
