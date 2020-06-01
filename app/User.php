<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail
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
        return $this->hasMany('App\Conta');
    }

    public function movimentos()
    {
        return $this->hasManyThrough('App\Movimento', 'App\Conta');
    }

    public function getAdmAttribute($adm)
    {
        return $this->attributes['adm'] = ($adm) ? 'Admin' : 'Normal';
    }

    public function getBloqueadoAttribute($bloqueado)
    {
        return $this->attributes['bloqueado'] = ($bloqueado) ? 'Bloqueado' : 'Normal';
    }

    public function contasPartilhas()
    {
            return $this->belongsToMany('App\Conta', 'autorizacoes_contas', 'user_id', 'conta_id')->withPivot('so_leitura');
    }
}
