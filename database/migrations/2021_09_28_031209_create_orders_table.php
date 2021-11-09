<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 70)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('agency_id');
            $table->integer('status')->default(3)->comment('0 CANCELED | 1 PAID | 2 PROCESSING | 3 OPPENED ');
            $table->string('payment_method')->nullable();
            $table->double('tax')->default(0);
            $table->double('subtotal')->nullable();
            $table->double('total');
            $table->double('discount')->default(0);
            $table->double('total_paid')->default(0);
            $table->string('promo')->nullable();
            $table->timestamp('expire_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('agency_id')->references('id')->on('agencies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
