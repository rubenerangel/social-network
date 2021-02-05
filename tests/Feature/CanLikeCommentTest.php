<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CanLikeCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_users_can_not_like_comments()
    {
        // $this->withoutExceptionHandling();
        $comment = Comment::factory()->create();

        $response = $this->postJson(route('comments.likes.store', $comment));

        $response->assertStatus(401);
    }

    /** @test*/
    public function an_authenticated_user_can_like_comments()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $this->actingAs($user)->postJson( route('comments.likes.store', $comment) );

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'status_id' => $comment->id,
        ]);
    }
}
