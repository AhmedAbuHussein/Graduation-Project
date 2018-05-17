<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCovenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covenants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('employee_id')->unsigned();
            $table->integer('datastore_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();

            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onUpdate("cascade")
                    ->onDelete("cascade");

            $table->foreign('datastore_id')
                    ->references('id')
                    ->on('datastores')
                    ->onUpdate("cascade")
                    ->onDelete("cascade");

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
        Schema::dropIfExists('covenants');
    }
}
