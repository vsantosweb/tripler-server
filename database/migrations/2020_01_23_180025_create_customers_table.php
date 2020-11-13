<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid', 70)->unique();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('phone')->nullable();
            $table->string('birthday');
            $table->string('gender')->nullable();
            $table->tinyInteger('is_agency')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('home_dir')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
