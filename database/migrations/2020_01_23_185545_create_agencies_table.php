<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('agency_type_id');
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('document')->nullable();
            $table->string('logo')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->boolean('first_time')->default(true);
            $table->boolean('accepeted_terms')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('home_dir')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('agency_type_id')->references('id')->on('agency_types');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agencies');
    }
}
