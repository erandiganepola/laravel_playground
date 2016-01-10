<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("student",function(Blueprint $table){
            $table->increments('id');
            $table->string("name");
            $table->integer('examination_no')->unique();
            $table->string('password');
            $table->integer("results")->unsigned();
            $table->integer("school_id")->unsigned();
            $table->rememberToken();
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
        Schema::drop("student");
    }
}
