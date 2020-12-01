<?php

namespace Tests\Browser;

use App\Models\Status;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanSeeAllStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     * @test
     * @throws \Throwable
     */
    public function users_can_see_all_statuses_on_the_homepage()
    {
        $statuses = Status::factory()->times(3)->create();

        $this->browse(function (Browser $browser) use($statuses) {
            $browser->visit('/')
                ->waitForText($statuses->first()->body);

            foreach($statuses as $status) {
                $browser->assertSee($status->body);
            }
        });
    }
}
