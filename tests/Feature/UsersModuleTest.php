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

        $this->get('/usuarios/'.$user->id)
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
        	->assertSee('Crear nuevo usuario');

    }

        /**
    * @test */
    function it_loads_the_users_edit_page()
    {

        $this->get('/usuarios/5/edit')
        	->assertStatus(200)
        	->assertSee('Editar usuario con id: 5');


        $this->get('/usuarios/nuevo/edit')
        	->assertStatus(404)
        	->assertDontSee('Editar usuario con id: nuevo');

    }

    /**
    * @test */
    function it_creates_a_new_user()
    {
       

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

        $this->assertDatabaseMissing('users',[
            'email' =>'duilio@styde.net'
        ]);

        $this->assertEquals(0, User::count());
    }    
}
