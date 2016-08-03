<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('assignments', function (Blueprint $table){

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('description');

            $table->string('user_control');
            $table->timestamps();

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
        Schema::dropIfExists('assignments');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
