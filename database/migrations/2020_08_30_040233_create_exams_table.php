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
            $table->string('status')->default("available");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
