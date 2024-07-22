<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'password',
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
    ];


    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id', 'perfil_id');
    }

    public function regiao()
    {
        return $this->belongsToMany('App\RegiaoResponsavel', 'regiao_responsavel', 'regiao_id', 'user_id');
    }

    public function regioes()
    {
        return $this->belongsToMany(Regiao::class,
            'regiao_responsavel',
            'user_id',
            'regiao_id');
    }

    public function logs()
   	{
   		return $this->hasMany('App\Log', 'user_id');
   	}
}
