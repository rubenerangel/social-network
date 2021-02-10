<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function users_can_register()
    {
        // $this->withoutExceptionHandling();

        $userData = [
            'name'          => 'RubenRangel',
            'first_name'    => 'Ruben',
            'last_name'     => 'Rangel',
            'email'         => 'rubenrang@gmail.com',
            'password'      => 'password',
            'password_confirmation' => 'password',
        ];

        $resp = $this->post(route('register'), $userData);

        $resp->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'RubenRangel',
            'first_name' => 'Ruben',
            'last_name' => 'Rangel',
            'email' => 'rubenrang@gmail.com',
        ]);

        $this->assertTrue(
            Hash::check('password', User::first()->password),
            'The password needs to be hashed'
        );
    }
}
