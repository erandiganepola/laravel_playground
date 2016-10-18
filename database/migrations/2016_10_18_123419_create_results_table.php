<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("student_id")->unsigned();
            $table->integer("examination_id")->unsigned();
            $table->integer("attempt")->unsigned()->default(1);
            $table->timestamps();
            $table->unique(["student_id", "examination_id", "attempt"]);

            $table->foreign("student_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("examination_id")->references("id")->on("examinations")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('results');
    }
}
