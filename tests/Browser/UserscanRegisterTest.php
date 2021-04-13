<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     *  @test
     * @throws \Throwable
     */
    public function user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'RubenRangel')
                    ->type('first_name', 'Ruben')
                    ->type('last_name', 'Rangel')
                    ->type('email', 'ruben@gmail.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('@register-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated();
        });
    }

    /**
     *  @test
     * @throws \Throwable
     */
    public function user_cannot_register_with_invalid_information()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', '')
                    
                    ->press('@register-btn')
                    ->assertPathIs('/register')
                    ->assertPresent('@validation-errors');
        });
    }
}
