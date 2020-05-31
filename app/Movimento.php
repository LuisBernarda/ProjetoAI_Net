<?php

namespace App;

use App\Conta;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreMovimento as RequestsStoreMovimento;
class Movimento extends Model
{
    //
    protected $softDeletes = true;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Conta');
    }

      public function categoria()
    {
        return $this->hasOne('App\Categoria','id','categoria_id');
    }

    public function categorias(){
        return $this->hasmany('App\Categoria','categoria_id','id');
    }



}
