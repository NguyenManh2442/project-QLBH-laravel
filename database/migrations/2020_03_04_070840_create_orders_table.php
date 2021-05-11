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
            $table->bigInteger('user_id')-> unsigned();
            $table->bigInteger('shipper_id')-> unsigned()->nullable();
            $table->dateTime('shipped_date')->nullable();
            $table->dateTime('order_date');
            $table->string('status');
            $table->string('total_money');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('customers');
            $table->foreign('shipper_id')
                ->references('id')
                ->on('employees');
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
