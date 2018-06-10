<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_size', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            // $table->foreign('product_id')
            //     ->references('id')->on('products')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table->integer('size_id')->unsigned()->index();
            // $table->foreign('size_id')
            //     ->references('id')->on('sizes')
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
        Schema::dropIfExists('product_size');
    }
}
