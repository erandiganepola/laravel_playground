<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAccountTeacherForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_account',function(Blueprint $table){
            $table->foreign('teacher_id')->references('teacher_id')->on('teacher')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop the foreign key in the user_account table, before dropping the table.
        Schema::table('user_account', function($table)
        {
            $table->dropForeign('user_account_teacher_id_foreign');
        });
    }
}
