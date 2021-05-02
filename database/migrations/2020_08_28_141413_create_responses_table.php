<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('response');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
