<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function applicantExam()
    {
        return $this->hasOne(ApplicantExam::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
