<?php

namespace App;

use App\Applicant;
use Illuminate\Database\Eloquent\Model;

class AppResult extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'user_id', 'status', 'exam_date', 'exam_result', 'exam_score', 'time_start', 'time_end'];
}
