<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhilippineProvincesTable extends Migration
{
    public function up()
    {
        Schema::create('philippine_provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('psgc_code');
            $table->string('province_description');
            $table->string('region_code');
            $table->string('province_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('philippine_provinces');
    }
}
