<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $primarykey = 'id';
    protected $keytype = 'integer';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'adm', 'bloqueado', 'NIF', 'telefone', 'foto',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' =>        'datetime',
        'updated_at' =>        'datetime',
        
    ];

    public function contas()
    {
        //return $this->belongsToMany('App\Conta', 'autorizacoes_contas');
        return $this->hasMany('App\Conta');
    }
}
