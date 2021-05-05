<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
