<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    use SoftDeletes;
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        //
    ];


    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill'); // skill_user
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class)->withDefault();
    }

    public static function findByEmail($email)
    {

        return static::where(compact('email'))->first();
    }


    public function isAdmin()
    {
        return $this->role == 'Admin';
    }
}
