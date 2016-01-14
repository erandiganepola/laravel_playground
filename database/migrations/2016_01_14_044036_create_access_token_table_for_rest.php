<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessTokenTableForRest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_token_rest',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string("token");
            $table->timestamps();
        });

        $m = new \App\AccessTokenRest();
        $m->token = "rn2pzJ91Q1jeUkB8k7HeLALUDURkp6V6619B7uaH";
        $m->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("access_token_rest");
    }
}
