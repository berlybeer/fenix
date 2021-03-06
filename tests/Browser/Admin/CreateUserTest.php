<?php

namespace Tests\Browser\Admin;

use App\Profession;
use App\Skill;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateUserTest extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test void
     */
    public function a_user_can_be_created()
    {

        $profession = factory(Profession::class)->create();
        $skillA = factory(Skill::class)->create();
        $skillB = factory(Skill::class)->create();

        $this->browse(function(Browser $browser) use($profession, $skillA, $skillB){
            $browser->visit('usuarios/nuevo')
                ->type('first_name', 'Duilio')
                ->type('last_name', 'Palacios')
                ->type('email', 'duilio@styde.net')
                ->type('password', 'laravel')
                ->type('bio','Programador')
                ->select('profession_id', $profession->id)
                ->type('twitter', 'https://twitter.com/silence')
                ->check("skills[{$skillA->id}]")
                ->check("skills[{$skillB->id}]")
                ->radio('role', 'user')
                ->press('Crear usuario')
                ->assertPathIs('/usuarios')
                ->assertSee('Duilio')
                ->assertSee('duilio@styde.net');
        });

        $this->assertCredentials([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
            'email' => 'duilio@styde.net',
            'password' => 'laravel',
            'role' => 'user',
        ]);

        $user = User::findByEmail('duilio@styde.net');

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'Programador',
            'twitter' => 'https://twitter.com/silence',
            'user_id' => $user->id,
            'profession_id' => $profession->id,

        ]);

        $this->assertDatabaseHas('user_skill',[
            'user_id' => $user->id,
            'skill_id' => $skillA->id,
        ]);


    }
}
