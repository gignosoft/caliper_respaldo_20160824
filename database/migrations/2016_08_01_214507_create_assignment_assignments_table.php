<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('state_assignment_assignments', function (Blueprint $table){

            $table->increments('id');
            $table->integer('state_assignment_id')->unsigned();
            $table->integer('assignment_id')->unsigned();

            $table->timestamps();

            $table->foreign('state_assignment_id')
                ->references('id')
                ->on('state_assignments')
                ->onDelete('cascade');

            $table->foreign('assignment_id')
                ->references('id')
                ->on('state_assignments')
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
        Schema::dropIfExists('state_assignment_assignments');
    }
}
