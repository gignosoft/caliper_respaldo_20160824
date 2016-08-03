<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('purchases', function(Blueprint $table){

            $table->increments('id');
            $table->integer('asset_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->dateTime('date');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->double('total');

            $table->string('user_control');
            $table->timestamps();

            $table->foreign('asset_id')
                ->references('id')
                ->on('assets')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('purchases');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
