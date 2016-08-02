<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('offices',function(Blueprint $table){

            $table->increments('id');
            $table->string('description');
            $table->string('details');
            $table->integer('city_id')->unsigned();

            $table->string('user_control');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('offices');
    }
}
