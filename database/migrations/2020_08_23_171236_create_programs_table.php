<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program_id');
            $table->string('program_name');
            $table->string('department');
            $table->timestamps();
        });

        DB::table('programs')->insert([
            array(
                'program_id' => 'MMA',
                'program_name' => 'BA Communication - Multimedia Arts',
                'department' => 'cas'
            ),
            array(
                'program_id' => 'BAB',
                'program_name' => 'BA Broadcasting',
                'department' => 'cas'
            ),
            array(
                'program_id' => 'CS',
                'program_name' => 'BS Computer Science',
                'department' => 'ccis'
            ),
            array(
                'program_id' => 'IT',
                'program_name' => 'BS Information Technology',
                'department' => 'ccis'
            ),
            array(
                'program_id' => 'IS',
                'program_name' => 'BS Information Systems',
                'department' => 'ccis'
            ),
            array(
                'program_id' => 'ACT',
                'program_name' => 'BS Accountancy',
                'department' => 'ety'
            ),
            array(
                'program_id' => 'ENT',
                'program_name' => 'BS Entrepreneurship',
                'department' => 'ety'
            ),
            array(
                'program_id' => 'HRM',
                'program_name' => 'BS Hotel and Restaurant Management',
                'department' => 'ety'
            ),
            array(
                'program_id' => 'TM',
                'program_name' => 'BS Tourism Management',
                'department' => 'ety'
            ),
            array(
                'program_id' => 'MarE',
                'program_name' => 'BS Marine Engineering',
                'department' => 'mare'
            ),
            array(
                'program_id' => 'MT',
                'program_name' => 'BS Marine Transportation',
                'department' => 'mare'
            ),
            array(
                'program_id' => 'Archi',
                'program_name' => 'BS Architecture',
                'department' => 'mitl'
            ),
            array(
                'program_id' => 'ChE',
                'program_name' => 'BS Chemical Engineering',
                'department' => 'mitl'
            ),
            array(
                'program_id' => 'CE',
                'program_name' => 'BS Civil Engineering',
                'department' => 'mitl'
            ),
            array(
                'program_id' => 'EE',
                'program_name' => 'BS Electrical Engineering',
                'department' => 'mitl'
            ),
            array(
                'program_id' => 'ECE',
                'program_name' => 'BS Electronics Engineering',
                'department' => 'mitl'
            ),
            array(
                'program_id' => 'IE',
                'program_name' => 'BS Industrial Engineering',
                'department' => 'mitl'
            ),
            array(
                'program_id' => 'ME',
                'program_name' => 'BS Mechanical Engineering',
                'department' => 'mitl'
            ),
            array(
                'program_id' => 'STEM',
                'program_name' => 'Science, Technology, Engineering and Mathematics',
                'department' => 'shs'
            ),
            array(
                'program_id' => 'ABM',
                'program_name' => 'Accountancy, Business and Management',
                'department' => 'shs'
            ),
            array(
                'program_id' => 'HUMSS',
                'program_name' => 'Humanities and Social Sciences',
                'department' => 'shs'
            ),
            array(
                'program_id' => 'PBM',
                'program_name' => 'Pre-Baccalaureate Maritime',
                'department' => 'shs'
            ),
            array(
                'program_id' => 'ICT',
                'program_name' => 'Information and Communications Technology',
                'department' => 'shs'
            ),
            array(
                'program_id' => 'HE',
                'program_name' => 'Home Economics',
                'department' => 'shs'
            ),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
