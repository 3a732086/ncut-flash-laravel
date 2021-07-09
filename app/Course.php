<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    //
    use SoftDeletes;
    protected $table = "courses";
    // public function course_topics()
    // {
    //     return $this->hasMany(Course_topics::class);
    // }
    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];

}
