<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('exam__subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('exam_id');
            $table->integer('subject_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam__subjects');
    }
}
