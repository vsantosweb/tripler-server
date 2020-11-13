<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripOrderTransactionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_order_transaction_history', function (Blueprint $table) {
            $table->string('code', 70)->unique();
            $table->decimal('amount', 8, 2);
            $table->decimal('tax', 8, 2);
            $table->string('ip')->nullable();
            $table->string('geo_location')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('customer_name');
            $table->string('customer_cpf');
            $table->string('agency_name');
            $table->string('agency_uid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_order_transaction_history');
    }
}
