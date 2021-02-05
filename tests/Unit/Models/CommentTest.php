<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_comment_belongs_to_a_user()
    {
        $comment = Comment::factory()->create();

        $this->assertInstanceOf(User::class, $comment->user);
    }

    /** @test */
    public function a_comment_morph_many_likes()
    {
        $this->withoutExceptionHandling();

        $comment = Comment::factory()->create();

        Like::factory()->create([
            'likeable_id' => $comment->id,          // 1
            'likeable_type' => get_class($comment), //App\\Models\\Comment
        ]);

        $this->assertInstanceOf(Like::class, $comment->likes->first() );
    }

    /** @test */
    public function a_comment_can_be_like_and_unlike()
    {
        $comment = Comment::factory()->create();

        $this->actingAs( User::factory()->create() );

        $comment->like();

        $this->assertEquals(1, $comment->fresh()->likes->count());

        $comment->unlike();

        $this->assertEquals(0, $comment->fresh()->likes->count());
    }

    /** @test */
    public function a_comment_can_be_liked_once()
    {
        $comments = Comment::factory()->create();

        $this->actingAs( User::factory()->create() );

        $comments->like();

        $this->assertEquals(1, $comments->likes->count());

        $comments->like();

        $this->assertEquals(1, $comments->fresh()->likes->count());
    }

    /** @test */
    public function a_comment_knows_if_it_has_been_liked()
    {
        $comment = Comment::factory()->create();

        $this->assertFalse($comment->isLiked());
        
        $this->actingAs(User::factory()->create());
        
        $this->assertFalse($comment->isLiked());

        $comment->like();

        $this->assertTrue($comment->isLiked());
    }

    /** @test */
    public function a_comment_knows_how_many_likes_it_has()
    {
        $comments = Comment::factory()->create();

        $this->assertEquals(0, $comments->likesCount());
        
        /* Like::factory()->times(2)->create([
            'status_id' => $comments->id
        ]); */

        Like::factory()->times(2)->create([
            'likeable_id' => $comments->id,          // 1
            'likeable_type' => get_class($comments), //App\\Models\\Status
        ]);

        $this->assertEquals(2, $comments->likesCount());
    }
}
