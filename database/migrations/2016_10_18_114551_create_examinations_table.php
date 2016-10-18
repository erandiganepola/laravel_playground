<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('examinations', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("year");
            $table->boolean("status")->default(true);
            $table->integer("created_by")->unsigned();
            $table->timestamps();

            $table->unique(["name", "year"]);
            $table->foreign("created_by")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('examinations');
    }
}
