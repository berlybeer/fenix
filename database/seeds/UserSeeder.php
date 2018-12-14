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

    	$professionId2 = DB::table('professions')->where('title','Desarrollador Front-end')->value('id');

    	$professionId3 = DB::table('professions')->where('title','Diseñador Web')->value('id');

    



        factory(User::class)->create([
           	'name' => 'Berly Pumaccajia',
        	'email' => 'berly@pumacajia.com',
        	'password' => bcrypt('laravel'),
        	'profession_id' => $professionId,
        	'is_admin' => true
        ]);


        factory(User::class)->create([
        	'profession_id' => $professionId
        ]);

        factory(User::class, 48)->create();



        DB::insert('INSERT INTO users(name, email, password, profession_id) VALUES (:name, :email,:password, :profession_id)', ['name' => 'serafin', 'email' => 'era@fin.com', 'password' => bcrypt('laravel'), 'profession_id' => $professionId2]);

        DB::delete('DELETE FROM users WHERE name = "serafin"');
    }
}
