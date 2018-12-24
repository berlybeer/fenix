<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeletesUserTest extends TestCase
{
	use RefreshDatabase;
    /**
    * @test */
    function it_deletes_a_user()
    {
 

       $user = factory(User::class)->create();

       $this->delete("usuarios/{$user->id}")
        ->assertRedirect('usuarios');

        $this->assertDatabaseEmpty('users');


    }
}
