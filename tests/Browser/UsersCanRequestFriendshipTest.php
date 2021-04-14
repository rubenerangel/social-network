<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanRequestFriendshipTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *  @throws \Throwable
     * @return void
     */
    public function user_can_request_friendship()
    {
        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        $this->browse(function (Browser $browser) use ($sender, $recipient) {
            $browser->loginAs($sender)
                    ->visit( route('users.show', $recipient) )
                    ->press('@request-friendship')
                    ->waitForText('Solicitud enviada...')
                    ->assertSee('Solicitud enviada...');
        });
    }
}
