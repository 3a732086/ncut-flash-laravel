<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_score extends Model
{
    //

    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }

    protected $table = "quiz_score";

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'score',
        'use_time',
        'fail'
    ];
}
