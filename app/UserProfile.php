<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
	// protected $guarded = [];
    protected $fillable = ['bio' , 'twitter', 'profession_id'];
}
