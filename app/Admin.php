<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public static function getAppPrograms()
    {
        return DB::table('applicants')
            ->join('programs', 'applicants.program_id', '=', 'programs.id')
            ->select('programs.program_id', DB::raw('count(*) as total'))
            ->groupBy('programs.program_id')
            ->get();
    }
}
