<?php

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

    	$professionId = DB::table('professions')
    					->whereTitle('Desarrollador back-end')
    					->value('id');

    	$professionId2 = DB::table('professions')->where('title','Desarrollador front-end')->value('id');


        DB::table('users')->insert([
        	'name' => 'Berly Pumaccajia',
        	'email' => 'berly@pumacajia.com',
        	'password' => bcrypt('laravel'),
        	'profession_id' => $professionId,
        ]);



        DB::insert('INSERT INTO users(name, email, password, profession_id) VALUES (:name, :email,:password, :profession_id)', ['name' => 'serafin', 'email' => 'era@fin.com', 'password' => bcrypt('laravel'), 'profession_id' => $professionId2]);

        DB::delete('DELETE FROM users WHERE name = "serafin"');
    }
}
