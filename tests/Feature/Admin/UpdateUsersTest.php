<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUsersTest extends TestCase
{



	use RefreshDatabase;

	protected $defaultData = [
            'name' => 'Duilo',
            'email' => 'duilio@styde.net',
            'password' => '123456',
            'profession_id' => '',
            'bio' => 'Programador de Laravel y Vue.js',
            'twitter' => 'https://twitter.com/silence',
            'role' => 'user',
	];

    /**
    * @test */
    function it_loads_the_edit_users_page()
    {
        


        $user = factory(User::class)->create();

  
        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee("Editar usuario")
            // ->assertViewHas('user' , $user);
            ->assertViewHas('user', function($viewUser) use ($user){
                return $viewUser->id == $user->id;
            });

    }  

    /**
    * @test */
    function it_updates_a_user()
    {
       $user = factory(User::class)->create();

         

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Duilo',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}");

       $this->assertCredentials([
            'name' => 'Duilo',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ]);

    }

    /**
    * @test */
    function the_name_is_required()
    {

 		$this->handleValidationExceptions();
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
            'name' => '',
            'email' => 'duilio@styde.net',
            'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'duilio@styde.net']);
    }


    /**
    * @test */
    function the_email_is_required()
    {
    	 $this->handleValidationExceptions();
       
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
            'name' => 'Duilio',
            'email' => '',
            'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Duilio']);
    } 

    /**
    * @test */
    function the_email_must_be_valid()
    {

    	 $this->handleValidationExceptions();
       
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
            'name' => 'Duilio Palacios',
            'email' => 'email-no-valido',
            'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Duilio Palacios']);
    } 

    /**
    * @test */
    function the_email_must_be_unique()
    {

    	$this->handleValidationExceptions();

       factory(User::class)->create([
            'email' => 'existing-email@example.com',
        ]);


        // 

       $user = factory(User::class)->create([
            'email' => 'berly@pumacajia.com',
       ]);

        $this->from("usuarios/{$user->id}/editar")
                  ->put("usuarios/{$user->id}", [
            'name' => 'Berly Pumacajia',
            'email' => 'existing-email@example.com',
            'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);


    } 

    /**
    * @test */
    function the_users_email_can_stay_the_same()
    {

       $user = factory(User::class)->create([
            'email' => 'duilio@styde.net'
       ]);

        $this->from("usuarios/{$user->id}/editar")
                  ->put("usuarios/{$user->id}", [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => '12345678'
            ])
            ->assertRedirect("usuarios/{$user->id}");


        $this->assertDatabaseHas('users', [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',


        ]);
    }                       




    /**
    * @test */
    function the_password_is_optional()
    {


        $oldPassword = 'clave_anterior';

       $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
       ]);

        $this->from("usuarios/{$user->id}/editar")
                  ->put("usuarios/{$user->id}", [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => ''
            ])
            ->assertRedirect("usuarios/{$user->id}");


        $this->assertCredentials([
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => $oldPassword,

        ]);
    }





}
