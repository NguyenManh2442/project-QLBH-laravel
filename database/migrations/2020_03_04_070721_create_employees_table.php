<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mail_address', 100);
            $table->string('password', 255);
            $table->string('name', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone', 15)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('avatar')->nullable();
            $table->string('role', 2);
            $table->string('status', 2);
            $table->string('token', 255)->nullable();
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
        Schema::dropIfExists('employees');
    }
}
