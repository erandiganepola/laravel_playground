<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamResultsTableForRest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_results_rest',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('examination_number')->unique();
            $table->date("dob");
            $table->string('district');
            $table->integer("marks")->unsigned();
            $table->string("school");
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
        Schema::drop("exam_results_rest");
    }
}
