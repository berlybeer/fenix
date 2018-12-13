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
    function it_loads_the_users_details_page()
    {
        $this->get('/usuarios/5')
        	->assertStatus(200)
        	->assertSee('Mostrando detalle del usuario: 5');

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
}
