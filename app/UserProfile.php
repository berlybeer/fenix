<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{

	use SoftDeletes;
	protected $guarded = [];

	public function profession() //profession_id = profession_id
    {
        return $this->belongsTo(Profession::class)->withDefault([
        	'title' => 'Sin profesión'
        ]);
        //si tabla de la bd no cumple con esta convencion la pasamos como segundo argumento:
        //return $this->belongsTo(Profession::class, 'id_profession')
    }

}
