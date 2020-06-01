<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    public $timestamps = false;
    protected $softDeletes=true;
    //
    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function movimentos()
    {
        return $this->hasMany('App\Movimento');
    }


    public function usersPartilhas()
    {
            return $this->belongsToMany('App\User', 'autorizacoes_contas', 'conta_id', 'user_id')->withPivot('so_leitura');
    }

}
