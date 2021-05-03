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
            $table->string('username', 50);
            $table->string('password', 255);
            $table->string('email', 100)->unique();
            $table->string('token', 255)->nullable();
            $table->string('status', 2);
            $table->string('full_name', 255)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->integer('coin')->nullable();
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
