<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantExamsTable extends Migration
{
    public function up()
    {
        Schema::create('applicant_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('applicant_id');
            $table->integer('exam_id')->default(0);
            $table->float('exam_score')->default(0);
            $table->string('time_start')->default('pending');
            $table->string('time_end')->default('pending');
            $table->string('exam_result')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applicant_exams');
    }
}
