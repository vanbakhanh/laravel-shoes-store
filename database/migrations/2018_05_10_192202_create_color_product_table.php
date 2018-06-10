<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            // $table->foreign('product_id')
            //     ->references('id')->on('products')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table->integer('color_id')->unsigned()->index();
            // $table->foreign('color_id')
            //     ->references('id')->on('colors')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
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
        Schema::dropIfExists('color_product');
    }
}
