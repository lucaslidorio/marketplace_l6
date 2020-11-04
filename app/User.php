<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Store;

class User extends Authenticatable
{
/*
 1:1 - um para um (usuário e loja) hasOne e belongsTO
 1:N - um para muitos (loja e produtos) hasMany belongsTO
 N:N - muitos para muitos (Produtos de categorias) belongsToMany

*/

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        
    ];

    public function store(){
        //um usuário possui uma loja
        return $this->hasOne(Store::class);
    }

}
