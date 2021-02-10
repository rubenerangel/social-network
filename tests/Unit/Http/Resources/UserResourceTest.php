<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\User;
use App\Models\Status;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_resources_must_have_the_necessary_fields()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        /* Transforma el estado y lo devuelve como queremos */
        $userResource = UserResource::make($user)->resolve();

        $this->assertEquals(
            $user->name, 
            $userResource['name']
        );

        $this->assertEquals(
            $user->link(), 
            $userResource['link']
        );

        $this->assertEquals(
            $user->avatar(), 
            $userResource['avatar']
        );
    }
}
