<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @method static where(string $string, $email)
 * @method static create(Array $data)
 * @method static find($id)
 * @method static \Illuminate\Database\Eloquent\Builder first()

 */
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



    /**
     * @param $email
     * @return array
     */
    public static function findWithEmail($email)
    {
        return  static::where('email' , $email)->first();
    }

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
