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

            $table->foreign('store_id')->refrences('id')->on('stores')->onUpdate('cascade');
            $table->foreign('additem_id')->refrences('id')->on('additems')->onUpdate('cascade');
            $table->foreign('user_id')->refrences('id')->on('users')->onUpdate('cascade');
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
