<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source');
            $table->float('quantity');
            $table->float('price');
            $table->string('permision')->unique();

            $table->integer('datastore_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('datastore_id')
                    ->references('id')
                    ->on('datastores')
                    ->onUpdate("cascade");
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate("cascade")
                    ->onDelete("set null");
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additems');
    }
}
