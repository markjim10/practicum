<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppExamResultsTable extends Migration
{
    public function up()
    {
        Schema::create('app_exam_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('applicant_id');
            $table->integer('subject_id');
            $table->float('score');
            $table->string('result');
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_exam_results');
    }
}
