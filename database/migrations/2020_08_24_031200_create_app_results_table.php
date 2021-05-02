<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppResultsTable extends Migration
{
    public function up()
    {
        Schema::create('app_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('applicant_id');
            $table->string('status')->default('pending');
            $table->integer('exam_date')->default(0);
            $table->string('exam_result')->default('pending');
            $table->float('exam_score')->default(0);
            $table->string('time_start')->default('pending');
            $table->string('time_end')->default('pending');
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_results');
    }
}
