<?php

namespace App\Http\Controllers;

use App\User;
use App\Choice;
use App\Subject;
use App\Question;
use App\Applicant;
use App\ApplicantExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GenerateController extends Controller
{
    public function index()
    {
        return view('home.generate_app');
    }

    public function createSubject()
    {
        $name = 'Math';
        $num_questions = 10;

        $subject = new Subject();
        $subject->subject_name = $name;
        $subject->num_questions = $num_questions;
        $subject->status = "approved";
        $subject->save();

        $subject = Subject::where('id', $subject->id)->first();

        for ($i = 0; $i < $num_questions; $i++) {
            $question = new Question();
            $question->subject_id = $subject->id;
            $question->question = $i . ' + ' . $i;
            $question->answer = $i + $i;
            $question->save();

            for ($j = 0; $j < 4; $j++) {
                $choice = new Choice();
                $choice->question_id = $question->id;
                $choice->choice = $question->answer + $j;
                $choice->save();
            }
        }
    }

    public function generateRandom($min, $max)
    {
        return rand($min, $max);
    }

    public function generateSchool()
    {
        $min = 1;
        $max = 9;
        $r = rand($min, $max);
        $school = "";

        if ($r == 1) {
            $school = 'Malayan Colleges Laguna';
        } else if ($r == 2) {
            $school = 'Canossa Academy';
        } else if ($r == 3) {
            $school = 'Letran Calamba';
        } else if ($r == 4) {
            $school = 'Saint John Colleges';
        } else if ($r == 5) {
            $school = 'Pulo Senior High School';
        } else if ($r == 6) {
            $school = 'UPLB';
        } else if ($r == 7) {
            $school = 'Lyceum';
        } else if ($r == 8) {
            $school = 'LCBA';
        } else if ($r == 9) {
            $school = 'Calamba Institute';
        }

        return $school;
    }

    public function generatePhone()
    {
        return "09" . rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9);
    }

    public function generateBday()
    {
        $bday = rand(1990, 2002) . "-" . rand(1, 12) . "-" . rand(1, 30);
        return date("F d Y", strtotime($bday));
    }

    public function generate_applicants(Request $request)
    {
        $total = 0;
        $app = Applicant::all();
        $i = intval($app->count());
        $total = intval($app->count()) + 10;

        for ($i = $i; $i < $total; $i++) {

            $rand = [];
            $rand[0] = $this->generateRandom(0, 35);
            $rand[1] = $this->generateRandom(0, 35);
            $rand[2] = $this->generateRandom(0, 35);
            $rand[3] = $this->generateRandom(1, 60); // province
            $rand[4] = $this->generateRandom(1, 5); // city
            $rand[5] = $this->generateRandom(1, 100); // brgy
            $rand[6] = $this->generateRandom(1, 19); //program
            $rand[7] = $this->generateRandom(0, 30); //school

            $firstName = array(
                "Joshua", "John Paul", "Christian", "Justine", "John Mark", "John Lloyd",
                "Adrian", "John Michael", "Angelo", "Justin", "John Carlo", "James", "Mark", "Kenneth", "Jayson", "Mark Anthony", "Daniel", "John Rey", "Ryan", "Angel", "Angela", "Mary Joy", "Mariel", "Jasmine", "Mary Grace", "Kimberly", "Stephanie", "Christine", "Michelle", "Jessa Mae", "Jenny", "Angeline", "Erica", "Bea", "Janelle", "Kyla", "Althea"
            );

            $lastName = array('Dela Cruz', 'Garcia', 'Reyes', 'Ramos', 'Mendoza', 'Santos', 'Flores', 'Gonzales', 'Bautista', 'Villanueva', 'Fernandez', 'Cruz', 'De Guzman', 'Lopez', 'Perez', 'Castillo', 'Francisco', ' Rivera', ' Aquino', 'Castro', 'Sanchez', 'Torres', 'De Leon', 'Domingo', 'Martinez', 'Rodriguez', ' Santiago', 'Sariano', 'Delos Santos', 'Diaz', 'Hernandez', 'Tolentino', 'Valdez', 'Ramirez', 'Morales', 'Mercado');

            $user = new User();
            $user->email = "app" . $i . "@test.com";
            $user->username = $user->email;
            $user->password = Hash::make('1234');
            $user->role = 'applicant';
            if ($request->hasFile('photo')) {
                $user->photo = addslashes($_FILES['photo']['tmp_name']);
                $user->photo = file_get_contents($user->photo);
                $user->photo = base64_encode($user->photo);
            }
            $user->save();

            $app = new Applicant();
            $app->user_id = $user->id;
            $app->status = 'approved';
            $app->first_name = $firstName[$rand[0]];
            $app->middle_name = $lastName[$rand[1]];
            $app->last_name = $lastName[$rand[2]];
            $province = DB::table('philippine_provinces')
                ->where('philippine_provinces.id', '=', $rand[3])
                ->value('province_description');
            $city = DB::table('philippine_cities')
                ->join('philippine_provinces', 'philippine_provinces.province_code', '=', 'philippine_cities.province_code')
                ->where('philippine_provinces.id', '=', $rand[3])
                ->value('city_municipality_description');

            $app->province = $province;
            $app->city = $city;
            $app->phone = $this->generatePhone();
            $app->date_of_birth = $this->generateBday();

            $program = DB::table('programs')
                ->where('programs.id', '=', $rand[6])
                ->value('programs.id');

            $dept = DB::table('programs')
                ->where('programs.id', '=', $rand[6])
                ->value('department');

            if ($dept != "shs") {
                $app->application = "college";
            } else {
                $app->application = "shs";
            }

            $app->program_id = $program;
            $app->school_last_attended = $this->generateSchool();

            if ($request->hasFile('card_photo')) {
                $app->card_photo = addslashes($_FILES['card_photo']['tmp_name']);
                $app->card_photo = file_get_contents($app->card_photo);
                $app->card_photo = base64_encode($app->card_photo);
            }

            $app->save();

            $applicantsExam = new ApplicantExam();
            $applicantsExam->applicant_id = $app->id;
            $applicantsExam->save();
        }
        return redirect()->back()->with('message', 'Applicant generated.');
    }
}
