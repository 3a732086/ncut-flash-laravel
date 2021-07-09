<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yellow extends Model
{
    //

    // public function course()
    // {
    //     return $this->belongsTo(Course::class);
    // }

    protected $table = "yellow";

    protected $primaryKey = 'id';

    protected $fillable = [
        'Verb',
        'Noun',
        'Adjective',
        'Adverb',
        'Count'
    ];
}
