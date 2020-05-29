<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    //

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Conta');
    }

      public function categoria()
    {
        return $this->hasOne('App\Categoria','id');
    }

}
