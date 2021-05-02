<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function applicantsCount()
    {
        return $this->applicants->count();
    }

    public static function selectedApplication($id)
    {
        if ($id == "college") {
            return Program::where('department', '!=', 'shs')->get();
        } else {
            return Program::where('department', '=', 'shs')->get();
        }
    }
}
