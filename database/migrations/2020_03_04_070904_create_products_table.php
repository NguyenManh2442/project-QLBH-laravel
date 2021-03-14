<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name', 255);
            $table->string('supplier', 255);
            $table->bigInteger('category_id')-> unsigned();
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->float('discount');
            $table->integer('status');
            $table->string('description', 255);
            $table->string('image', 255);
            $table->string('size_s', 2);
            $table->string('size_m', 2);
            $table->string('size_l', 2);
            $table->string('size_xl', 2);
            $table->string('size_xxl', 2);
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
