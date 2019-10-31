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
        'name', 'email', 'password', 'first_name' , 'client_id','token' ,'last_name' ,'title', 'category_id'
    ];
    public $appends = ['secret_password'];
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
    public function isLabeler()
    {
        return $this->id == 101;
    }
    public function isHorizon()
    {
        return $this->client_id == 18;
    }
    public function isHartford()
    {
        return $this->client_id == 26;
    }

}
