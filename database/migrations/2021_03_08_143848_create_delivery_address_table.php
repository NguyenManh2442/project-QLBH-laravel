<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')-> unsigned();
            $table->string('name');
            $table->string('phone_number');
            $table->string('wards');
            $table->string('district');
            $table->string('province');
            $table->string('detailed_address');
            $table->integer('status');
            $table->foreign('user_id')
                ->references('id')
                ->on('customers');
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
        Schema::dropIfExists('delivery_address');
    }
}
