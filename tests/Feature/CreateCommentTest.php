<?php

namespace Tests\Feature;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/
    public function guest_users_cannot_create_comments()
    {
        $status = Status::factory()->create();
        $comment = ['body' => 'Mi primer comentario'];

        $response = $this->postJson(route('statuses.comments.store', $status), $comment);

        $response->assertStatus(401);
    }

    /** @test */ 
    public function authenticated_users_can_comment_statuses()
    {
        // $this->withoutExceptionHandling();
        $status = Status::factory()->create();
        $user = User::factory()->create();
        $comment = ['body' => 'Mi primer comentario'];

        $response = $this->actingAs($user)
            ->postJson(route('statuses.comments.store', $status), $comment);

        $response->assertJson([
            'data' => ['body' => $comment['body']],
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'status_id' => $status->id,
            'body' => $comment['body'],
        ]);
    }

    /** @test */
    public function a_comment_requires_a_body()
    {
        // Para que laravel NO maneje las exepciones
        // $this->withoutExceptionHandling();
        
        // 1. Given => Teniendo
        // Teniendo un usuario autenticado
        $status = Status::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user); // Cuado hacemos login

        // 2. When => Cuando
        // Cuando hace un post request a status y el campo body esta vacio
        $response = $this->postJson(route('statuses.comments.store', $status), [
            'body' => ''
        ]);

        $response->assertStatus(422);

        // 3. Then => Entonces
        // Entonces veo un mensaje de Error
        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
        
    }
}
