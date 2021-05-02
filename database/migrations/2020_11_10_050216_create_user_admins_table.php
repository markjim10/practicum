<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('user_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('user_admins')->insert([
            array(
                'user_id' => '1',
                'name' => 'Admin Name'
            ),
            array(
                'user_id' => '2',
                'name' => 'System Admin Name'
            ),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('user_admins');
    }
}
