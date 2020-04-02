<?php

namespace Tests;

use App\User;
use Illuminate\Support\Arr;

class InitialSetupTest extends TestCase
{
    public function test_users_are_redirected_to_login()
    {
        $this->get('/')->assertRedirect(route('login'));

        $this->get(route('login'))->assertSee('Create one');
    }

    public function test_user_can_be_created()
    {
        $data = [
            'name' => 'Steve',
            'email' => 'steven_bauman@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->post(route('register'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', Arr::only($data, ['name', 'email']));
    }

    public function test_users_cannot_register_another_again()
    {
        factory(User::class)->create();

        $this->get(route('register'))->assertRedirect('/');
        $this->post(route('register'))->assertRedirect('/');
    }
}
