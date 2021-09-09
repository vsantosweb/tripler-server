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
            $table->uuid('uuid');
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('document_1')->nullable()->comment('cpf');
            $table->string('document_2')->nullable()->comment('rg');
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->text('avatar')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->boolean('first_time')->default(true);
            $table->boolean('accepeted_terms')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('home_dir')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
