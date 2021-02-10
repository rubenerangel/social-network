<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
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
    }
}
