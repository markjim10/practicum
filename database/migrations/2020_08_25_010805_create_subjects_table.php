<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('num_questions');
            $table->string('status')->default("pending");
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
