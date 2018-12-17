<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'bio', 'photo' , 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public function profession() //profession + _id = profession_id
    {
        return $this->belongsTo(Profession::class);
        //si tabla de la bd no cumple con esta convencion la pasamos como segundo argumento:
        //return $this->belongsTo(Profession::class, 'id_profession')
    }

    public static function findByEmail($email)
    {

        return static::where(compact('email'))->first();
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
