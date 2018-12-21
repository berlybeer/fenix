<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// $professions = DB::select('SELECT id FROM professions WHERE title = :title LIMIT 0,1', [
    	// 	'title' => 'Desarrollador back-end',
    	// ]);

    	$professionId = Profession::where('title','Desarrollador Back-end')->value('id');

        $user = factory(User::class)->create([
           	'name' => 'Berly Pumaccajia',
        	'email' => 'berly@pumacajia.com',
        	'password' => bcrypt('laravel'),

        	'is_admin' => true
        ]);

        $user->profile()->create([
            'bio' => 'programador, profesor, editor, escritor',
            'profession_id' => $professionId,
        ]);
      
        factory(User::class, 29)->create()->each(function($user){
            $user->profile()->create(
                factory(\App\UserProfile::class)->raw()
            );
        });


    }
}
