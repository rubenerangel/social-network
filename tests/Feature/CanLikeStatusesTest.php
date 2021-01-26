<?php

namespace Tests\Feature;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanLikeStatusesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_can_not_like_statuses()
    {
        // $this->withoutExceptionHandling();

        // 1. Given => Tenienedo
        // Un usuario no autenticado NO puede DAR Like

        // Para que laravel NO maneje las exepciones
        // $this->withoutExceptionHandling();
        
        // 2. When => Cuando
        // Cuando hace un post request a like
        $status = Status::factory()->create();

        $response = $this->postJson(route('statuses.likes.store', $status));

        //3. Then => Lo redirigimos al login
        // $response->assertRedirect('login');
        $response->assertStatus(401);
    }

    /** @test*/
    public function an_authenticated_user_can_like_statuses()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $status = Status::factory()->create();

        $this->actingAs($user)->postJson( route('statuses.likes.store', $status) );

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id,
        ]);
    }

    /** @test*/
    public function an_authenticated_user_can_unlike_statuses()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $status = Status::factory()->create();

        $this->actingAs($user)->postJson( route('statuses.likes.store', $status) );

        $this->actingAs($user)->deleteJson( route('statuses.likes.destroy', $status) );

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'status_id' => $status->id,
        ]);
    }
}
