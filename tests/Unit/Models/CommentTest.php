<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Traits\HasLikesTraits;
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
    public function a_comment_model_use_the_trait_has_likes()
    {
        $this->assertClassUsesTrait(HasLikesTraits::class, Comment::class);
    }
}
