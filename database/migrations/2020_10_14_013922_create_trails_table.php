<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrailsTable extends Migration
{
    public function up()
    {
        Schema::create('trails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('trail');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trails');
    }
}
