<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
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
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public static function createUser($data){
        DB::transaction(function () use ($data){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            $user->profile()->create([
                'bio' => $data['bio'],
                'twitter' => $data['twitter'],
            ]);
        });
    }


    public function profession() //profession + _id = profession_id
    {
        return $this->belongsTo(Profession::class);
        //si tabla de la bd no cumple con esta convencion la pasamos como segundo argumento:
        //return $this->belongsTo(Profession::class, 'id_profession')
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'user_skill'); // skill_user
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
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
