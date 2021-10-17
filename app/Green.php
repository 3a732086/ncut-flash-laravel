<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Green extends Model
{
    //

    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }

    protected $table = "green";

    protected $primaryKey = 'id';

    protected $fillable = [
        'Verb',
        'Noun',
        'Adjective',
        'Adverb',
        'Count'
    ];
}
