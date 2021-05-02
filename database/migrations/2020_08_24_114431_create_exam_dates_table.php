<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamDatesTable extends Migration
{
    public function up()
    {
        Schema::create('exam_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('exam_id');
            $table->string('status')->default("approved");
            $table->string('exam_date');
            $table->string('exam_start');
            $table->string('exam_end');
            $table->string('exam_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_dates');
    }
}
