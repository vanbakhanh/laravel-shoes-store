<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content');
            $table->integer('product_id')->unsigned()->index();
            // $table->foreign('product_id')
            //     ->references('id')->on('products')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            // $table->foreign('user_id')
            //     ->references('id')->on('users')
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
        Schema::dropIfExists('comments');
    }
}
