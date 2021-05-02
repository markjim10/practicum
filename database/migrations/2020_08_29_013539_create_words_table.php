<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('response_id');
            $table->string('word');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('words');
    }
}
