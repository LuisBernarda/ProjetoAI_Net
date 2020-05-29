<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    public $timestamps = false;
    use SoftDeletes;
    //
    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function movimentos()
    {
        return $this->hasMany('App\Movimento');
    }


}
