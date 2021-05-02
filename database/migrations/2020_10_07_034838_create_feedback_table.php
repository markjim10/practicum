<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('applicant_id');
            $table->string('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
