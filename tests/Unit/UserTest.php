<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test*/
    public function route_key_name_is_set_to_name()
    {
        $user = User::factory()->make();

        $this->assertEquals('name', $user->getRouteKeyname(), 'The route key name must be name');
    }

    /** @test*/
    public function user_has_a_link_to_their_profile()
    {
        $user = User::factory()->make();

        $this->assertEquals(route('users.show', $user), $user->link());
    }

    /** @test*/
    public function user_has_an_avatar()
    {
        $user = User::factory()->make();

        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $user->avatar());
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $user->avatar);
    }

    /**  @test */
    public function a_user_has_many_statuses()
    {
        $user = User::factory()->create();

        Status::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf( Status::class, $user->statuses->first() );
    }
}
