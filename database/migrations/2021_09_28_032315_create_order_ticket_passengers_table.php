<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTicketPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_ticket_passengers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_ticket_id');
            $table->string('name');
            $table->string('type')->nullable();;
            $table->string('email')->nullable();;
            $table->string('document')->nullable();;
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->double('tax')->default(0);
            $table->double('discount')->default(0);
            $table->double('price');
            $table->double('total');
            $table->timestamps();

            $table->foreign('order_ticket_id')->references('id')->on('order_tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_ticket_passengers');
    }
}
