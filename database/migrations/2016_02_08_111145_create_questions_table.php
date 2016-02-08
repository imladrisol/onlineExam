<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->text('option1');
            $table->text('option2');
            $table->text('option3');
            $table->text('option4');
            $table->integer('answer');
            $table->timestamps();
        });

        Schema::create('subject_question', function(Blueprint $table){
            $table->increments('id');
            $table->integer('subject_id')->unsigned()->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->integer('question_id')->unsigned()->index();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
        Schema::drop('subject_question');
        Schema::drop('questions');
    }
}
