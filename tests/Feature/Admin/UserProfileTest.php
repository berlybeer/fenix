<?php

namespace Tests\Feature\Admin;

use App\Profession;
use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
	use RefreshDatabase;

	protected $defaultData = [
		'name' => 'Sergio',
		'email' => 'sergio@styde.net',
		// 'password' => '123456',
		'bio' => 'Programador de Laravel y Vue.js',
		'twitter' => 'https://twitter.com/sergio',
	];

    public function setUp()
    {
        parent::setUp();
        $this->markTestIncomplete();
    }



    /**
    * @test void
    */
    public function a_user_can_edit_its_profile()
    {
        $user = factory(User::class)->create();
        $user->profile()->save(factory(UserProfile::class)->make());

        $newProfession = factory(Profession::class)->create();

        $response = $this->get('/editar-perfil/');
        $response->assertStatus(200);

        $response = $this->put('/editar-perfil/', [
        	'name' => 'Sergio',
        	'email' => 'sergio@styde.net',
        	// 'password' => '123456',
        	'bio' => 'Programador de Laravel y Vue.js',
        	'twitter' => 'https://twitter.com/sergio',
        	'profession_id' => $newProfession->id,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
        	'name' => 'Sergio',
        	'email' => 'sergio@styde.net',
        	// 'password' => '123456',
        ]);

        $this->assertDatabaseHas('user_profiles', [
        	'bio' => 'Programador de Laravel y Vue.js',
        	'twitter' => 'https://twitter.com/sergio',
        	'profession_id' => $newProfession->id,
        ]);
    }    

         /**
         * @test void
     */
    public function the_user_cannot_change_its_role()
    {
        $user = factory(User::class)->create([
        	'role' => 'user'
        ]);

        $response = $this->put('/editar-perfil/', $this->withData([
        	'role' => 'admin',
        ]));

        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
        	'id' => $user->id,
        	'role' => 'user',
        ]);
    }

         /**
         * @test void
     */
    public function the_user_cannot_change_its_password()
    {
        factory(User::class)->create([
        	'password' => bcrypt('old123'),
        ]);

        $response = $this->put('/editar-perfil/', $this->withData([
        	'email' => 'sergio@styde.net',
        	'password' => 'new456'
        ]));

        $response->assertRedirect();

        $this->assertCredentials([
        	'email' => 'sergio@styde.net',
        	'password' => 'old123',
        ]);
    }

}
