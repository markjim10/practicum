<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password');
            $table->longText('photo')->nullable();
            $table->string('role');
        });

        DB::table('users')->insert([
            array(
                'username' => 'admin',
                'email' => 'admin@test.com',
                'password' => Hash::make("1234"),
                'role' => 'admin'
            ),
            array(
                'username' => 'sysadmin',
                'email' => 'sysadmin@test.com',
                'password' => Hash::make("1234"),
                'role' => 'sysadmin'
            ),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
