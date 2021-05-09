<?php

namespace App\Services;

use App\User;
use App\Applicant;
use Coreproc\MsisdnPh\Msisdn;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterService
{
    public function validateEmail($email)
    {
        if (User::where('email', $email)->first() == null) {
            return "not taken";
        } else {
            return "taken";
        }
    }

    public function validatePhone($phone)
    {
        if (Msisdn::validate($phone)) {
            return "valid";
        } else {
            return "invalid";
        }
    }

    public function getMonths()
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];
    }

    public function getProvinces()
    {
        return DB::table('philippine_provinces')->orderBy('province_description', 'asc')->get();
    }

    public static function registerApplicant($request)
    {
        $email = request('email_address');
        $password = Hash::make('1234');
        $dateOfBirth = request('birth_month') . ' ' . request('birth_day') . ' ' . request('birth_year');
        $province = DB::table('philippine_provinces')
            ->where('province_code', request('province'))
            ->value('province_description');

        $user = new User();
        $user->email = $email;
        $user->username = $email;
        $user->password = $password;
        $user->role = 'applicant';
        if ($request->hasFile('photo')) {
            $user->photo = addslashes($_FILES['photo']['tmp_name']);
            $user->photo = file_get_contents($user->photo);
            $user->photo = base64_encode($user->photo);
        }
        $user->save();

        $foreign = $user->id;
        $applicant = new Applicant();
        $applicant->user_id = $foreign;
        $applicant->first_name = request('first_name');
        $applicant->last_name = request('last_name');
        $applicant->middle_name = request('middle_name');
        $applicant->status = 'pending';
        $applicant->province = $province;
        $applicant->city = request('city');
        $applicant->phone = request('phone');
        $applicant->date_of_birth = $dateOfBirth;
        $applicant->application = request('application');
        $applicant->program_id = request('preferred_program');
        $applicant->school_last_attended = request('school_last_attended');

        if ($request->hasFile('card_photo')) {
            $applicant->card_photo = addslashes($_FILES['card_photo']['tmp_name']);
            $applicant->card_photo = file_get_contents($applicant->card_photo);
            $applicant->card_photo = base64_encode($applicant->card_photo);
        }

        $applicant->save();
    }

    public function sendMail($status)
    {
        // if ($status == "approved") {
        //     Mail::raw([], function ($message) use ($user) {
        //         $message->from('mjimdomondon@gmail.com', 'Practicum 2 Project');
        //         $message->to($user->email);
        //         $message->subject('Your application in the OJT 2 Project entrance exam has been approved');
        //         $message->setBody('<h2>You have been approved and can now log in your account by using your email address, and "changeme" for your password.</h2>', 'text/html');
        //     });
        // } else {
        //     Mail::raw([], function ($message) use ($user) {
        //         $message->from('mjimdomondon@gmail.com', 'Practicum 2 Project');
        //         $message->to($user->email);
        //         $message->subject('Your application in the OJT 2 Project entrance exam has been denied');
        //         $message->setBody('<h2>Sorry you have been denied.</h2>', 'text/html');
        //     });
        // }
    }
}
