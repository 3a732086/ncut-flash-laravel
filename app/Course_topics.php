<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_topics extends Model
{
    //

    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }

    protected $table = "course_topics";

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'number',
        'eng_topic',
        'chi_topic'
    ];
}
