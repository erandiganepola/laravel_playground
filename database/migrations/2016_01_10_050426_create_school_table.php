<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string("city");
            $table->string('district');
            $table->integer("in_quota")->default(null);
            $table->boolean('goes_out')->default(false);
            $table->boolean("comes_in")->default(false);
            $table->integer("cutoff_mark")->unsigned();
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
        Schema::drop('school');
    }
}
