<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdititemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edititems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source');
            $table->string('permision');
            $table->integer('quantity');
            $table->float('price');
            
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('additem_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('additem_id')->references('id')->on('additems');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edititems');
    }
}
