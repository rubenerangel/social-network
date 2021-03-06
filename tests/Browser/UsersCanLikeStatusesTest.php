<?php

namespace Tests\Browser;

use App\Models\Comment;
use App\Models\User;
use App\Models\Status;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanLikeStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function users_can_like_and_unlike_statuses()
    {
        $user = User::factory()->create();
        $status = Status::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $status) {
            $browser->loginAs($user)
                ->visit('/')
                ->waitForText($status->body)
                ->assertSeeIn('@likes-count', 0)
                ->press('@like-btn')
                ->waitForText('TE GUSTA')
                ->assertSee('TE GUSTA')
                ->assertSeeIn('@likes-count', 1) 

                ->press('@like-btn')
                ->waitForText('ME GUSTA')
                ->assertSee('ME GUSTA')
                ->assertSeeIn('@likes-count', 0);
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_users_cannot_like_statuses()
    {
        $status = Status::factory()->create();

        $this->browse(function (Browser $browser) use ($status) {
            $browser
                ->visit('/')
                ->waitForText($status->body)
                ->press('@like-btn')
                ->assertPathIs('/login');
        });
    }
}
