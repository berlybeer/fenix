<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UsersModuleTest extends TestCase
{

    use RefreshDatabase;
    /**
    * @test */
    function it_show_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Joel',

        ]);

        factory(User::class)->create([
            'name' => 'Ellie'
        ]);

        $this->get('/usuarios')
        	->assertStatus(200)
        	->assertSee('Joel')
        	->assertSee('Ellie')
        	->assertSee('Listado de usuarios');

    }

    /**
    * @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {

        $this->get('/usuarios')
        	->assertStatus(200)
        	->assertSee('No hay usuarios registrados');

    }


    /**
    * @test */
    function it_displays_the_users_details()
    {

        $user = factory(User::class)->create([
            'name' => 'Duilio Palacios'
        ]);

        $this->get("/usuarios/{$user->id}")
        	->assertStatus(200)
            ->assertSee('Duilio Palacios');

    }

    /**
    * @test */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
  
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');

    }    



    /**
    * @test */
    function it_loads_the_new_users_page()
    {
  
        $this->get('/usuarios/nuevo')
        	->assertStatus(200)
        	->assertSee('Crear usuario');

    }


    /**
    * @test */
    function it_creates_a_new_user()
    {
       $this->withoutExceptionHandling();

        $this->post('/usuarios/', [
            'name' => 'Duilo',
            'email' => 'duilio@styde.net',
            'password' => '123456'
        ])->assertRedirect('usuarios');

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

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
            'name' => '',
            'email' => 'duilio@styde.net',
            'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());
    }  

    /**
    * @test */
    function the_email_is_required()
    {
       

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
            'name' => 'Duilio',
            'email' => '',
            'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    } 

    /**
    * @test */
    function the_email_must_be_valid()
    {
       

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
            'name' => 'Duilio',
            'email' => 'correo-no-valido',
            'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    } 

    /**
    * @test */
    function the_email_must_be_unique()
    {

        // $this->withoutExceptionHandling();

       factory(User::class)->create([
            'email' => 'email@existente.com',
       ]);

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
            'name' => 'Duilio',
            'email' => 'email@existente.com',
            'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    } 



    /**
    * @test */
    function the_password_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => ''
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }  


    /**
    * @test */
    function it_loads_the_edit_users_page()
    {
        $this->withoutExceptionHandling();


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

         $this->withoutExceptionHandling();

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
    function the_name_is_required_when_updating_the_user()
    {


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
    function the_email_is_required_when_updating_the_user()
    {
       
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
    function the_email_must_be_valid_when_updating_the_user()
    {
       
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
    function the_email_must_be_unique_when_updating_the_user()
    {

        self::markTestIncomplete();
        return;

        // $this->withoutExceptionHandling();

       $user = factory(User::class)->create([
            'email' => 'email@existente.com',
       ]);

        $this->from("usuarios/{$user->id}/editar")
                  ->put("usuarios/{$user->id}", [
            'name' => 'Duilio Palacios',
            'email' => 'email@existente.com',
            'password' => '123456'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    } 



    /**
    * @test */
    function the_password_is_required_when_updating_the_user()
    {

       $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
                  ->put("usuarios/{$user->id}", [
            'name' => 'Duilio Palacios',
            'email' => 'duilio@styde.com',
            'password' => ''
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', ['email' => 'duilio@styde.net']);
    }                  

}
