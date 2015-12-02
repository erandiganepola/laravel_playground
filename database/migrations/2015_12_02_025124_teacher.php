<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Teacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->string('teacher_id',10);
            $table->string('name',100);
            $table->string('gender',1);
            $table->string('nic',10);
            $table->string('address',200);
            $table->date('date_of_birth');
            $table->boolean('active')->default(1);

            $table->primary('teacher_id');
            $table->unique('nic');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('teacher');
    }
}
