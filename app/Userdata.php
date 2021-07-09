<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Userdata extends Model
{
    //
    // protected $table = "userdatas";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
