<?php

namespace App\Http\Controllers;

use App\User;
use App\Applicant;
use App\AppResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GenerateController extends Controller
{
    public function index()
    {
        return view('/generate/applicants');
    }

    public function approve()
    {
        $app = AppResult::all();
        foreach ($app as $item) {
            $item->status = "approved";
            $item->save();
        }
        return 'approved';
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
            $app->brgy = "Brgy. " . $city . " " . $province;
            $app->phone = "09" . rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9) .  rand(0, 9);

            $bday = rand(1990, 2002) . "-" . rand(1, 12) . "-" . rand(1, 30);
            $app->date_of_birth = date("F d Y", strtotime($bday));

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

            $appResult = new AppResult();
            $appResult->applicant_id = $app->id;
            $appResult->status = "approved";
            $appResult->save();
        }
        return redirect()->back()->with('message', 'Applicant generated.');
    }
}
