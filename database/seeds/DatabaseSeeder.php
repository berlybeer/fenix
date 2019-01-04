<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

    	$this->truncateTables([
    		'users',
            'user_profiles',
            'user_skill',
    		'professions',
            'skills',
            'teams',

    	]);

        $this->call([
            ProfessionSeeder::class,
            SkillSeeder::class,
            TeamSeeder::class,
            UserSeeder::class,
        
        ]);

    }

    public function truncateTables(array $tables)
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    	foreach ($tables as $table) {
    		DB::table($table)->truncate();
    	}
    	

    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
