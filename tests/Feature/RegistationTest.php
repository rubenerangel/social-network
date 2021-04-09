<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistationTest extends TestCase
{
    use RefreshDatabase;
    /** @test*/
    public function users_can_register()
    {
        $this->withoutExceptionHandling();

        $this->get(route('register'))->assertSuccessful();

        $resp = $this->post(route('register'), $this->userValidData());

        $resp->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'RubenRangel5',
            'first_name' => 'Ruben',
            'last_name' => 'Rangel',
            'email' => 'rubenrang@gmail.com',
        ]);

        $this->assertTrue(
            Hash::check('password', User::first()->password),
            'The password needs to be hashed'
        );
    }

    /** @test*/
    public function the_name_is_required()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => null])
        )->assertSessionHasErrors('name');
    }

    /** @test*/
    public function the_name_must_be_unique()
    {
        User::factory()->create(['name' => 'RubenRangel']);

        $this->post(
            route('register'), 
            $this->userValidData(['name' => 'RubenRangel'])
        )->assertSessionHasErrors('name');
    }

    /** @test*/
    public function the_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => 'as'])
        )->assertSessionHasErrors('name');
    }

    /** @test*/
    public function the_name_may_only_contain_letters_and_numbers()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => 'Ruben Rangel'])
        )->assertSessionHasErrors('name');

        // $this->post(
        //     route('register'), 
        //     $this->userValidData(['name' => 'RubenRangel2'])
        // )->assertSessionHasErrors('name');
    }

    /** @test*/
    public function the_name_must_be_a_string()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => 1234])
        )->assertSessionHasErrors('name');
    }

    /** @test*/
    public function the_name_may_not_be_greater_than_60_characters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => Str::random(61)])
        )->assertSessionHasErrors('name');
    }

    /* first_name */
    /** @test*/
    public function the_first_name_is_required()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => null])
        )->assertSessionHasErrors('first_name');
    }

    /** @test*/
    public function the_first_name_may_only_contain_letters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => 'Ruben5'])
        )->assertSessionHasErrors('first_name');

        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => 'Ruben<>'])
        )->assertSessionHasErrors('first_name');
    }

    /** @test*/
    public function the_first_name_must_be_a_string()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => 1234])
        )->assertSessionHasErrors('first_name');
    }
    
    /** @test*/
    public function the_first_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => 'as'])
        )->assertSessionHasErrors('first_name');
    }

    /** @test*/
    public function the_first_name_may_not_be_greater_than_60_characters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => Str::random(61)])
        )->assertSessionHasErrors('first_name');
    }

    /* last_name */
    /** @test*/
    public function the_last_name_is_required()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => null])
        )->assertSessionHasErrors('last_name');
    }

    /** @test*/
    public function the_last_name_may_only_contain_letters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => 'Ruben5'])
        )->assertSessionHasErrors('last_name');

        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => 'Ruben<>'])
        )->assertSessionHasErrors('last_name');
    }

    /** @test*/
    public function the_last_name_must_be_a_string()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => 1234])
        )->assertSessionHasErrors('last_name');
    }
    
    /** @test*/
    public function the_last_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => 'as'])
        )->assertSessionHasErrors('last_name');
    }

    /** @test*/
    public function the_last_name_may_not_be_greater_than_60_characters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => Str::random(61)])
        )->assertSessionHasErrors('last_name');
    }

    /* Email */
    /** @test*/
    public function the_email_is_required()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['email' => null])
        )->assertSessionHasErrors('email');
    }

    /** @test*/
    public function the_email_must_be_a_valid_email_address()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['email' => 'invalid@'])
        )->assertSessionHasErrors('email');
    }

    /** @test*/
    public function the_email_must_be_unique()
    {
        User::factory()->create(['email' => 'rubenrang@gmail.com']);
        $this->post(
            route('register'), 
            $this->userValidData(['email' => 'rubenrang@gmail.com'])
        )->assertSessionHasErrors('email');
    }

    /* Password */
    /** @test*/
    public function the_password_is_required()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['password' => null])
        )->assertSessionHasErrors('password');
    }

    /** @test*/
    public function the_password_must_be_a_string()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['password' => 1234])
        )->assertSessionHasErrors('password');
    }

    /** @test*/
    public function the_password_must_be_at_least_6_characters()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['password' => 'asdrw'])
        )->assertSessionHasErrors('password');
    }

    /** @test*/
    public function the_password_must_be_confirmed()
    {
        $this->post(
            route('register'), 
            $this->userValidData(
                [
                    'password' => 'secret',
                    'password_confirmation' => null,
                ]
            )
        )->assertSessionHasErrors('password');
    }

    /**
     * @param array $overrides
     * @return array
     */
    protected function userValidData($overrides = []): array
    {
        return array_merge([
            'name'          => 'RubenRangel5',
            'first_name'    => 'Ruben',
            'last_name'     => 'Rangel',
            'email'         => 'rubenrang@gmail.com',
            'password'      => 'password',
            'password_confirmation' => 'password',
        ], $overrides);
    }
}
