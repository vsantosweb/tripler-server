<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTicketPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_ticket_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_ticket_id');
            $table->string('name');
            $table->double('tax');
            $table->string('accommodation_name');
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
        Schema::dropIfExists('order_ticket_packages');
    }
}
