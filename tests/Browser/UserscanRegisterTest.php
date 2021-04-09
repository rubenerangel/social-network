<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserscanRegisterTest extends DuskTestCase
{
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
                    ->press('@register-btn', 'password')
                    ->assertPathIs('/', 'password')
                    ->assertAuthenticated()
                    ;
        });
    }
}
