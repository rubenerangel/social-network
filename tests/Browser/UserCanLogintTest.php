<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserCanLogintTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** 
     * @test
     * @throws \Throwable
     */
    public function registered_users_can_login()
    {
        $user = User::factory()->create();

        // dd(User::find(1));

        $this->browse(function (Browser $browser) use($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('@login-btn')
                ->assertPathIs('/home')
                ->screenshot('login')
                ->assertAuthenticated();
        });
    }

    /** 
     * @test void
     * @throws \Throwable
     */
    public function users_canNOT_login_with_invalid_information()
    {
        

        $this->browse(function (Browser $browser)  {
            $browser->visit('/login')
                ->type('email', '')
                
                ->press('@login-btn')
                ->assertPathIs('/login')
                ->screenshot('login')
                ->assertPresent('@validation-errors');
        });
    }
}
