<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exam_name');
            $table->string('exam_status')->default("activated");
            $table->string('exam_date');
            $table->string('exam_start');
            $table->string('exam_end');
            $table->string('exam_type');
            $table->integer('total_examinees')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
