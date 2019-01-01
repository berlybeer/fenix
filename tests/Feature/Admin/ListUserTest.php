<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListUserTest extends TestCase
{
	use RefreshDatabase;
    protected $profession;
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
    function it_shows_the_deleted_users()
    {
        factory(User::class)->create([
            'name' => 'Joel',
            'deleted_at' => now(),

        ]);

        factory(User::class)->create([
            'name' => 'Ellie'
        ]);

        $this->get('/usuarios/papelera')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios en papelera')
            ->assertSee('Joel')
            ->assertDontSee('Ellie');


    }      

}
